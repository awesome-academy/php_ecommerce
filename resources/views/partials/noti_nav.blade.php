<li class="dropdown nav-item dropdown-cart">
    <a href="#" class="nav-link nav-cart" data-toggle="dropdown">
        <i class="fas fa-bell icon-nav"></i>
        <span class="badge badge-pill badge-info badge-noti notify-count">
            {{ Auth::user()->unreadNotifications->count() }}
        </span>
    </a>
    <div class="dropdown-menu-cart dropdown-menu dropdown-menu-right animate slideIn">
        <h4 class="dropdown-header text-right notify-markAllRead">@lang('common.text.nav.mark_as_read')</h4>
        <div class="dropdown-divider"></div>
        <div class="notify-container">
            @foreach(Auth::user()->notifications as $notification)
            <div class="row notify-detail {{ $notification->unread() ? 'notify-color-unread' : '' }} {{ $notification->id }}">
                <a class="notify-markSingleRead dropdown-item d-flex align-items-center" id="noti-{{ $notification->id }}" data-id="{{ $notification->id }}">
                    <div>
                        <span class="small notify-time">{{ $notification->created_at->diffForHumans() }}</span>
                        <p class="notify-text font-weight-bold">@lang('common.user.order.notify', [
                                'id' => $notification->data['order_id']
                            ])
                           <span class="badge badge-pill {{ $notification->data['order_class'] }}">
                                {{ $notification->data['order_status'] }}
                           </span>
                       </p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-sm-12 text-center">
                <h6 class="dropdown-item-text notify-removeAll">
                    @lang('common.text.nav.remove_notify')
                </h6>
            </div>
        </div>
    </div>
</li>
