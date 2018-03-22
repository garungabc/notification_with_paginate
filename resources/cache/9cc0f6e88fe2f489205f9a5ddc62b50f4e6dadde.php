
<?php $__env->startSection('style'); ?>
	<style type="text/css">
		.content {
            text-align: justify;
        }
        .link-homepage {
            font-size: 25px;
        }
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<h1 class="text-center link-homepage" ><a href="<?php echo e($site_url); ?>"><?php echo e('HOPECOM.ORG'); ?></a></h1>
	<p class="text-center title-mail fz-16">Thông báo về việc một kiến nghị đã được cập nhật</p>
	<p class="fz-16">Xin chào <strong><?php echo e($name_signer); ?></strong>,</p>
	<p class="fz-16"><strong><?php echo e($name_author); ?></strong> vừa chia sẻ một thông tin cập nhật của kiến nghị <strong>"<?php echo e($post->post_title); ?>"</strong>, với nội dung:</p>
	<p class="content fz-16">
		"<?php echo e($content); ?>"
	</p>
	<p class="fz-14">Bạn có thể xem chi tiết link ở đây: <a href="<?php echo e($link); ?>">xem chi tiết</a></p>
	<p class="note-2 border-t-b">
		<i class="fz-12">Để từ chối nhận tin cập nhật về kiến nghị này xin vui lòng email đến <a href="mailto:hopecom.vn@gmail.com">hopecom.vn@gmail.com</a> hoặc <a href="mailto:hopecom.vn@gmail.com">info@hopecom.org</a></i>
	</p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>