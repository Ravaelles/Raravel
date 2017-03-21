<?php
//{!! Notification::showAll() !!}
?>

@if (session()->has('flash_notification.message'))
<div class="alert alert-{{ session('flash_notification.level') }} notification notification-{{ session('flash_notification.level') }}">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

    {!! session('flash_notification.message') !!}
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".notification").css({'margin-right': '-200px', 'display': 'inherit'})
                .animate({'margin-right': '0px'}, 400);
        setTimeout(function() {
            $(".notification").animate({'margin-right': '-200px'}, 1500)
            setTimeout(function() {
                $(".notification").remove();
            }, 2000);
        }, 8000);
    });
</script>
@endif