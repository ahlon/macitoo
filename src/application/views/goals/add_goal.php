
    <div class="row"></div>
    
    <section>

    </section>
    <div class="row">
        <div class="span8">
          <form class="form-horizontal" method="post" action="/goals/add_goal">
            <fieldset>
              <div class="control-group">
                <label class="control-label" for="input01">目标</label>
                <div class="controls">
                  <input type="text" class="input-xlarge" id="goal" name="goal">
                </div>
              </div>
              
              <div class="control-group">
              
                <label class="control-label" >类型</label>
                <div class="controls">
					<label class="radio"> <input type="radio" name="goalType" id="todo" value="1" > TODO</label>
					<label class="radio"> <input type="radio"  name="goalType" id="habit" value="2" > 习惯养成</label>
					<label class="radio"> <input type="radio"  name="goalType" id="project" value="3" > 系统项目</label>
					<label class="radio"> <input type="radio"  name="goalType" id="shoppinglist" value="4"> 购物列表</label>
                </div>
              </div>
                
         <?php if (isset($validation_error) && $validation_error == true ) {
		    		echo '<div class="alert alert-error">
		  					<strong>目标和类型不能为空!</strong>
						</div>';
		         } else if ( isset($add_goal_error) && $add_goal_error == true) {
		         	
		    		echo '<div class="alert alert-error">
		  					<strong>添加目标失败!</strong>
						</div>';
		         } else if ( isset($add_goal_success) && $add_goal_success == true) {
		         	
		    		echo '<div class="alert alert-success">
		  					<strong>添加目标成功!</strong>
						</div>';
		         } 
         
    	?>              
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">保存</button>
                <button type="reset" class="btn">取消</button>
              </div>
            </fieldset>
          </form>
          

                     <!-- Add data-toggle="buttons-radio" for radio style toggling on btn-group 
					<div class="btn-group" data-toggle="buttons-radio">
					  <button class="btn">习惯养成</button>
					  <button class="btn">系统项目</button>
					  <button class="btn">TODO</button>
					  <button class="btn">购物列表</button>
					</div>
					-->
        </div>
    </div>
</div>