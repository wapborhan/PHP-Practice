@if($contact_info->address || $contact_info->phone || $contact_info->email)
    <!--Card-->
    <div class="card mb-5" style="border: 6px solid rgba(0, 0, 0, 0.05);background-color: inherit;">
        <!--Card content-->
        <div class="card-body">
            <!--Section heading-->
            <h2 class="h1-responsive font-weight-bold text-center my-4">{!! $widget->title !!}</h2>
            {{-- <!--Section description-->
            <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact
            us directly. Our team will come back to you within
            a matter of hours to help you.</p> --}}
            <!--Grid column-->
            <div class="text-center">
                <ul class="list-unstyled mb-0">
                @if($contact_info->address)
                    <li><i class="fas fa-map-marker-alt fa-2x"></i>
                        <p>{!! $contact_info->address !!}</p>
                    </li>
                @endif
                @if($contact_info->phone)
                    <li><i class="fas fa-phone mt-4 fa-2x"></i>
                        <p>{!! $contact_info->phone !!}</p>
                    </li>
                @endif
                @if($contact_info->email)
                    <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                        <p>{!! $contact_info->email !!}</p>
                    </li>
                @endif
            </ul>
            </div>
            <!--Grid column-->
        </div>
    </div>
    <!--/.Card-->
@endif