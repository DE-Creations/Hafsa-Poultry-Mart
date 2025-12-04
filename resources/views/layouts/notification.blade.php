 <a class="dropdown-toggle header-action-icon" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
     <i class="icon-warning fs-4 lh-1 text-white"></i>
     <span class="count">{{ count($notifications) }}</span>
 </a>
 <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
     <h5 class="fw-semibold px-3 py-2 text-primary">
         Notifications
     </h5>
     <div>
         @foreach ($notifications as $notification)
             <div class="dropdown-item">
                 <div class="d-flex py-2">
                     <div class="icons-box md bg-danger rounded-circle me-3">
                         <i class="icon-alert-triangle text-white fs-4"></i>
                     </div>
                     <div class="m-0">
                         <h6 class="mb-1 fw-semibold">{{ $notification->customer->name }}</h6>
                         <p class="mb-2">{{ $notification->invoice->invoice_number }} -
                             Rs.{{ $notification->new_balance }}
                         </p>
                         <p class="small m-0 text-secondary">{{ $notification->invoice_date }}</p>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </div>
