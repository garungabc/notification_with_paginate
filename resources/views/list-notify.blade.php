<div class="page_list_notification">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="content_page">
					<p class="title_page">
						Thông báo của bạn
					</p>

					<ul class="list_item">
					@if($all_notify)
						@foreach($all_notify as $item)
						@php
							$notification = Vicoders\Notification\Models\Notify::find($item->notification_id);
							$message = '';
							if(!empty($notification->toArray())) {
								$message = $notification->content;
							}
							$link = get_permalink($notification->notifiable_id);
						@endphp
						<li class="item">
							<a href="{{ $link }}">{!! $message !!}</a>
						</li>
						@endforeach
					@else
						<li class="item"><a href="#">Hiện tại, không có thông báo nào cho bạn.</a></li>
					@endif
					</ul>

					<div class="paging">
						<div class="content_paging">
							{{ $paginator->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>