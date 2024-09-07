<div class="h-full flex items-center">
    <!-- BEGIN: Logo -->
    <a href="" class="-intro-x hidden md:flex">
        <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('dashboard_institution/dist/images/logo.svg')}}">
        <span class="text-white text-lg ml-3"> Icewall </span>
    </a>
    <!-- END: Logo -->
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
        <ol class="breadcrumb breadcrumb-light">
            <li class="breadcrumb-item"><a href="#">Application</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        </div>
        <a class="notification notification--light sm:hidden" href=""> <i data-lucide="search" class="notification__icon dark:text-slate-500"></i> </a>
        <div class="search-result">
            <div class="search-result__content">
                <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="" class="flex items-center">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="inbox"></i> </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="users"></i> </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="credit-card"></i> </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-1.jpg')}}">
                        </div>
                        <div class="ml-3">Russell Crowe</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">russellcrowe@left4code.com</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-11.jpg')}}">
                        </div>
                        <div class="ml-3">Denzel Washington</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">denzelwashington@left4code.com</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-3.jpg')}}">
                        </div>
                        <div class="ml-3">Arnold Schwarzenegger</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">arnoldschwarzenegger@left4code.com</div>
                    </a>
                    <a href="" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-11.jpg')}}">
                        </div>
                        <div class="ml-3">Johnny Depp</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">johnnydepp@left4code.com</div>
                    </a>
                </div>
                <div class="search-result__content__title">Products</div>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/preview-14.jpg')}}">
                    </div>
                    <div class="ml-3">Samsung Galaxy S20 Ultra</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Smartphone &amp; Tablet</div>
                </a>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/preview-8.jpg')}}">
                    </div>
                    <div class="ml-3">Sony A7 III</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Photography</div>
                </a>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/preview-5.jpg')}}">
                    </div>
                    <div class="ml-3">Nike Tanjun</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Sport &amp; Outdoor</div>
                </a>
                <a href="" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/preview-8.jpg')}}">
                    </div>
                    <div class="ml-3">Samsung Galaxy S20 Ultra</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Smartphone &amp; Tablet</div>
                </a>
            </div>
        </div>
    </div>

    <!-- END: Search -->
    <!-- Languages -->

    <div class="intro-x dropdown mr-4 sm:mr-6">
        <div class="dropdown-toggle  notification--bullet cursor-pointer text-slate-500 hover:text-slate-700 dark:hover:text-slate-300" role="button" aria-expanded="false" data-tw-toggle="dropdown">

            @if (App::getLocale() == 'ar')
            <img src="{{ asset('dashboard/assets/dist-admin/uploads/saudi-arabia.png') }}" alt="Egypt Flag" class="flag-icon w-4 h-4 mr-2">
            @else
            <img src="{{ asset('dashboard/assets/dist-admin/uploads/usa-icon.png') }}" alt="USA Flag" class="flag-icon w-4 h-4 mr-2">
            @endif

        </div>
        <div class="notification-content pt-2 dropdown-menu">
          <div class="notification-content__box dropdown-content bg-white dark:bg-slate-800 rounded shadow-lg">
            <div class="notification-content__title font-medium text-slate-800 dark:text-slate-200 mb-2">Languages</div>
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <a class="dropdown-item block px-4 py-2 text-slate-700 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-700" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
              @if ($localeCode === 'ar')
              <img src="{{ asset('dashboard/assets/dist-admin/uploads/saudi-arabia.png') }}" alt="Egypt Flag" class="flag-icon w-4 h-4 mr-2">
              @else
              <img src="{{ asset('dashboard/assets/dist-admin/uploads/usa-icon.png') }}" alt="USA Flag" class="flag-icon w-4 h-4 mr-2">
              @endif
              {{ $properties['native'] }}
            </a>
            @endforeach
          </div>
        </div>
      </div>

    <!-- END: Languages -->

    <!-- BEGIN: Notifications -->
    <div class="intro-x dropdown mr-4 sm:mr-6">
        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i> </div>
        <div class="notification-content pt-2 dropdown-menu">
            <div class="notification-content__box dropdown-content">
                <div class="notification-content__title">Notifications</div>
                <div class="cursor-pointer relative flex items-center ">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-1.jpg')}}">
                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Russell Crowe</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-11.jpg')}}">
                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Denzel Washington</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 20</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-3.jpg')}}">
                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Arnold Schwarzenegger</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">05:09 AM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-11.jpg')}}">
                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Johnny Depp</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                    </div>
                </div>
                <div class="cursor-pointer relative flex items-center mt-5">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('dashboard_institution/dist/images/profile-4.jpg')}}">
                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                    </div>
                    <div class="ml-2 overflow-hidden">
                        <div class="flex items-center">
                            <a href="javascript:;" class="font-medium truncate mr-5">Al Pacino</a>
                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">06:05 AM</div>
                        </div>
                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Notifications -->
    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in scale-110" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            <img alt="Midone - HTML Admin Template" src="{{ asset('dashboard_institution/dist/images/profile-4.jpg')}}">
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary/80 before:block before:absolute before:bg-black before:inset-0 before:rounded-md before:z-[-1] text-white">
                <li class="p-2">
                    <div class="font-medium">Russell Crowe</div>
                    <div class="text-xs text-white/60 mt-0.5 dark:text-slate-500">Software Engineer</div>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                </li>
                <li>
                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                </li>
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <form method="post" action="{{ route('institution.logout') }}">
                        @csrf
                        @method('delete')
                        <button  class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </button>

                    </form>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>
