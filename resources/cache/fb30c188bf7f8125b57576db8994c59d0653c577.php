<div class="page_list_notification">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="content_page">
					<p class="title_page">
						Thông báo của bạn
					</p>

					<ul class="list_item">
					<?php if($all_notify): ?>
						<?php $__currentLoopData = $all_notify; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$notification = Vicoders\Notification\Models\Notify::find($item->notification_id);
							$message = '';
							if(!empty($notification->toArray())) {
								$message = $notification->content;
							}
							$link = get_permalink($notification->notifiable_id);
						 ?>
						<li class="item">
							<a href="<?php echo e($link); ?>"><?php echo $message; ?></a>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php else: ?>
						<li>Hiện tại, không có thông báo nào cho bạn.</li>
					<?php endif; ?>
					</ul>

					<div class="paging">
						<div class="content_paging">
							<?php echo e($paginator->links()); ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>