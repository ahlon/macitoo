<div class="btn-toolbar">
    <div class="btn-group">
        <a class="btn <?php echo @$nav_idx == 'books' ? 'active' : '';?>" href="/books">书架</a>
    </div>
    <div class="btn-group">
        <a class="btn <?php echo @$nav_idx == 'do' ? 'active' : '';?>" href="/reading/status/in-progress">在读</a>
        <a class="btn <?php echo @$nav_idx == 'wish' ? 'active' : '';?>" href="/reading/status/wish">想读</a>
        <a class="btn <?php echo @$nav_idx == 'collect' ? 'active' : '';?>" href="/reading/status/collect">已读</a>
    </div>
    <div class="btn-group">
        <a class="btn <?php echo @$nav_idx == 'plan' ? 'active' : '';?>" href="/reading/plans">计划</a>
        <a class="btn <?php echo @$nav_idx == 'task' ? 'active' : '';?>" href="/reading/tasks">任务</a>
        <a class="btn <?php echo @$nav_idx == 'timer' ? 'active' : '';?>" href="/timers">记录</a>
        <a class="btn <?php echo @$nav_idx == 'review' ? 'active' : '';?>" href="/reading/review">回顾</a>
    </div>
</div>