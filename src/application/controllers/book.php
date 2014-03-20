<?php
require_once dirname(__FILE__) . '/base.php';
/**
 * 图书
 * @author ahlon
 */
class Book extends Base_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->service('book_service');
        $this->load->service('tag_service');
    }

    /**
     * 图书首页
     */
    function index() {
        $user_id = $this->session->userdata('user_id');
        $params = array();
        $books = $this->book_service->search($params, $this->order_by, $this->page_size, $this->p);
        $book_count = $this->book_service->count($params);
        
        $tags = array();
        // $tags = $this->tag_service->get_menus();
        
        $this->data['tags'] = $tags;

        $this->data['books'] = $books;
        $this->data['book_count'] = $book_count;
        
        $this->data['page'] = $this->p;
        $this->data['total_page'] = ceil($book_count / $this->page_size);
        
        if ($user_id) {
            $this->data['do_count'] = $this->rd_status_model->count(array('user_id'=>$user_id, 'status'=>'do'));
            $this->data['wish_count'] = $this->rd_status_model->count(array('user_id'=>$user_id, 'status'=>'wish'));
            $this->data['collect_count'] = $this->rd_status_model->count(array('user_id'=>$user_id, 'status'=>'collect'));
        }
        
        $this->data['nav_idx'] = 'books';
        // $this->widgets['content'][] = new Widget('reading/nav', $this->data);
        $this->widgets['content'][] = new Widget('book/list', $this->data);
        $this->render();
    }
    
    /**
     * 查看页面
     * @param unknown_type $id
     */
    function view($id) {
        $this->load->service('comment_service');
        
        $book = $this->book_service->get($id);
        $user_id = $this->session->userdata('user_id');
        
        $book['comment_count'] = 0;
        $this->data['item'] = $book;
        
        $comments = $this->comment_service->get_by_obj('book', $id, 10, 1);
        $this->data['comments'] = $comments;
        
        $this->layout = 'layouts/book_layout';
        $this->widgets['content'] = new Widget('book/view', $this->data);
        $this->widgets['right'][] = new Widget('default/blank');
        // $this->widgets['right'][] = new Widget('book/where_to_buy', $this->data);
        // $this->widgets['right'][] = new Widget('book/where_to_download', $this->data);
        $this->render();
    }
    
    function start_reading($id) {
        $this->load->model('user_model');
        $this->load->model('rd_task_model');
        $this->load->model('timer_model');
        $user_id = $this->user_id = $this->session->userdata('user_id');
        $book = $this->book_model->load($id);
        
        $task = array();
        $need_create_timer = true;
        //$on_going_timer = array();
        $on_going_timer_id = 0;
        
        //first check if task existed or not, create a task if not
        $rd_tasks = $this->rd_task_model->find_all(array('user_id'=>$user_id, 'book_id'=>$id), 'created_time desc');
        if(!$rd_tasks) {
        	$task = array('user_id'=>$user_id, 'book_id'=>$id, 'name'=>$book['title'], 'status'=>'new');
        	$this->rd_task_model->save($task);
        } else {
        	$task  = $rd_tasks[0];
        }
        //check if there's a pomodoro ongoing, redirect to timer if exist, otherwise create a timer.
        $timers = $this->timer_model->get_ongoing_timer($user_id, $task['id']);
        if($timers) {
        	$start_time = strtotime($timers[0]['start_time']);
        	$now = strtotime(date('Y-m-d H:i:s'));
        	
        	if(($start_time + TIMER_LEN) > $now ) {
        		$need_create_timer = false;
        		$on_going_timer_id = $timers[0]['timer_id'];
        	}
        }
        
        if($need_create_timer) {
	        $timer = array('name'=>$book['title'], 
			   'creator_id'=>$user_id, 
			   'status'=>'started',
	     	   'start_time'=>date('Y-m-d H:i:s'));
	        $this->timer_model->save($timer);
	        $on_going_timer_id = $timer['id'];
	        
	        $this->load->model('rd_task_timer_model');
	        
	        $task_timer_rel = array('task_id' => $task['id'], 'timer_id' => $timer['id']);
	        $this->rd_task_timer_model->save($task_timer_rel);
        }
        
        //TODO: how to pass ajax data?
    	echo $on_going_timer_id;
    }
}
?>
