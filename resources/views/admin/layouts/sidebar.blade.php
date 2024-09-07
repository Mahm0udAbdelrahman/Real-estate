<!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="index.html" class="header-logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-white.png')}}" class="desktop-white" alt="logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-white.png')}}" class="toggle-white" alt="logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-logo.png')}}" class="desktop-logo" alt="logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-dark.png')}}" class="toggle-dark" alt="logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/toggle-logo.png')}}" class="toggle-logo" alt="logo">
                    <img src="{{ asset('dashboard/assets/images/brand-logos/desktop-dark.png')}}" class="desktop-dark" alt="logo">
                </a>
            </div>
            <!-- End::main-sidebar-header -->
            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">
                <!-- Start::nav -->
                <nav class="main-menu-container nav nav-pills flex-column sub-open">
                    <div class="slide-left" id="slide-left">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path> </svg>
                    </div>
                    <ul class="main-menu">
                        <!-- Start::slide__category -->
                        <li class="slide__category"><span class="category-name">{{ __('Dashboard') }}</span></li>
                        <!-- End::slide__category -->

                        <!-- Start::slide -->
                        <li class="slide {{ request()->segment(2) == 'admin' ? 'active' : '' }}">
                            <a href="{{ route('admin') }}" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-home side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Administration') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                <li class="slide side-menu__label1">
                                    <a href="javascript:void(0)">Crypto Currencies</a>
                                </li>
                                {{--  @can('permissions')  --}}

                                <li class="slide {{ request()->segment(2) == 'permissions' ? 'active' : '' }}">
                                    <a href="{{ route('permissions.index') }}"  class="side-menu__item">{{ __('Permissions') }}</a>
                                </li>

                                {{--  @can('roles')  --}}
                                <li class="slide">
                                    <a href="{{ route('roles.index') }}" class="side-menu__item">{{ __('Roles') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                {{--  @can('admins')  --}}
                                <li class="slide">
                                    <a href="{{ route('admins.index') }}" class="side-menu__item">{{ __('Admins') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                {{--  @can('admins')  --}}
                                {{--  <li class="slide">
                                    <a href="{{ route('members.index') }}" class="side-menu__item">{{ __('Members') }}</a>
                                </li>  --}}
                                {{--  @endcan  --}}

                            </ul>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide has-sub {{ request()->segment(2) == 'countries' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Countries and cities') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">
                                {{--  @can('countries')  --}}
                                <li class="slide">
                                    <a href="{{ route('countries.index') }}" class="side-menu__item">{{ __('Countries') }}</a>
                                </li>
                                {{--  @endcan  --}}
                                {{--  @can('cities')  --}}
                                <li class="slide">
                                    <a href="{{ route('cities.index') }}" class="side-menu__item">{{ __('Cities') }}</a>
                                </li>
                                {{--  @endcan  --}}
                            </ul>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->
                        <li class="slide has-sub {{ request()->segment(2) == 'Companies' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Companies') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                {{--  @can('companies')  --}}
                                <li class="slide">
                                    <a href="{{ route('companies.index') }}" class="side-menu__item">{{ __('Companies') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                {{--  @can('advertisements')  --}}
                                <li class="slide">
                                    <a href="{{ route('advertisements.index') }}" class="side-menu__item">{{ __('Advertisements') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                <li class="slide">
                                    <a href="{{ route('insurances.index') }}" class="side-menu__item">{{ __('Insurances') }}</a>
                                </li>
                                <li class="slide">
                                    <a href="{{ route('specialties.index') }}" class="side-menu__item">{{ __('Specialties') }}</a>
                                </li>


                                

                               

                                 <li class="slide">
                                    <a href="{{ route('projects.index') }}" class="side-menu__item">{{ __('Projects') }}</a>
                                </li> 
                                

                                <li class="slide">
                                    <a href="{{ route('supplier_projects.index') }}" class="side-menu__item">{{ __('Supplier Projects') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('RentMaterial.index') }}" class="side-menu__item">{{ __('Rent Material') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('events.index') }}" class="side-menu__item">{{ __('Events') }}</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ route('conferences.index') }}" class="side-menu__item">{{ __('Conferences') }}</a>
                                </li>
                               

                                


                                <li class="slide">
                                    <a href="{{ route('bookings.index') }}" class="side-menu__item">{{ __('Bookings') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('packages.index') }}" class="side-menu__item">{{ __('Packages') }}</a>
                                </li>
                            </ul>
                        </li>
                        <!-- End::slide -->
                        <!-- Start::slide -->

                        <li class="slide has-sub {{ request()->segment(2) == 'ContractorCompany' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Contractor Company') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide">
                                    <a href="{{ route('ContractorCompany.index') }}" class="side-menu__item">{{ __('Contractor Conpamy') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('contractor_company_projects.index') }}" class="side-menu__item">{{ __('Contractor Company Projects') }}</a>
                                </li>
                            </ul>
                        </li>

                        <li class="slide has-sub {{ request()->segment(2) == 'ContractorPersons' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Contractor Person') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide">
                                    <a href="{{ route('ContractorPersons.index') }}" class="side-menu__item">{{ __('Contractor Person') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('contractor_person_projects.index') }}" class="side-menu__item">{{ __('Contractor Person Projects') }}</a>
                                </li>
                            </ul>
                        </li>


                        <li class="slide has-sub {{ request()->segment(2) == 'Suppliers' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Suppliers') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide">
                                    <a href="{{ route('suppliers.index') }}" class="side-menu__item">{{ __('Suppliers') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('supplier_projects.index') }}" class="side-menu__item">{{ __('Supplier Projects') }}</a>
                                </li>
                            </ul>
                        </li>


                        <li class="slide has-sub {{ request()->segment(2) == 'Partners' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Partners') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                <li class="slide">
                                    <a href="{{ route('partners.index') }}" class="side-menu__item">{{ __('Partners') }}</a>
                                </li>


                                <li class="slide">
                                    <a href="{{ route('partner_projects.index') }}" class="side-menu__item">{{ __('Partner Projects') }}</a>
                                </li>

                            </ul>
                        </li>
                        <li class="slide has-sub {{ request()->segment(2) == 'categories'  ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Information center') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">


                                {{--  @can('categories')  --}}
                                <li class="slide">
                                    <a href="{{ route('categories.index') }}" class="side-menu__item">{{ __('Categories') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                {{--  @can('posts')  --}}

                                <li class="slide">
                                    <a href="{{ route('posts.index') }}" class="side-menu__item">{{ __('Posts') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                {{--  <li class="slide">
                                    <a href="{{ route('asks.index') }}" class="side-menu__item">{{ __('Comments') }}</a>
                                </li>  --}}
                            </ul>
                        </li>
                        <!-- End::slide -->

                        <!-- Start::slide -->
                        <li class="slide has-sub {{ request()->segment(2) == 'languages' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('General Settings') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">

                                {{--  @can('languages')  --}}

                                <li class="slide">
                                    <a href="{{ route('languages.index') }}" class="side-menu__item">{{ __('Languages') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                {{--  @can('settings')  --}}

                                <li class="slide">
                                    <a href="{{ route('settings.edit',$setting->id) }}" class="side-menu__item">{{ __('Settings') }}</a>
                                </li>
                                {{--  @endcan  --}}

                                <li class="slide">
                                    <a href="{{ route('currencies.index') }}" class="side-menu__item">{{ __('Currencies') }}</a>
                                </li>

                                {{--  <li class="slide">
                                    <a href="{{ route('payment-methods.index') }}" class="side-menu__item">{{ __('Payment Methods') }}</a>
                                </li>  --}}


                            </ul>
                        </li>



                        <li class="slide has-sub {{ request()->segment(2) == 'register_persons' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('register persons') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">



                                <li class="slide">
                                    <a href="{{ route('register_persons.index') }}" class="side-menu__item">{{ __('All Persons') }}</a>
                                </li>




                            </ul>
                        </li>



                        <li class="slide has-sub {{ request()->segment(2) == 'register_companies' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('register companies') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">




                                <li class="slide">
                                    <a href="{{ route('register_companies.index') }}" class="side-menu__item">{{ __('All Companies') }}</a>
                                </li>





                            </ul>
                        </li>


                        <li class="slide has-sub {{ request()->segment(2) == 'ConsultingServicePerson' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Consulting Person') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">




                                <li class="slide">
                                    <a href="{{ route('ConsultingServicePerson.index') }}" class="side-menu__item">{{ __('Consulting Person') }}</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ route('consulting_person_projects.index') }}" class="side-menu__item">{{ __('Consulting Person Projecrs') }}</a>
                                </li>






                            </ul>
                        </li>



                        <li class="slide has-sub {{ request()->segment(2) == 'ConsultingServiceCompany' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Consulting Company') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">





                                <li class="slide">
                                    <a href="{{ route('ConsultingServiceCompany.index') }}" class="side-menu__item">{{ __('Consulting Company') }}</a>
                                </li>

                                <li class="slide">
                                    <a href="{{ route('consulting_company_projects.index') }}" class="side-menu__item">{{ __('Consulting Company Projects') }}</a>
                                </li>




                            </ul>
                        </li>



                        <li class="slide has-sub {{ request()->segment(2) == 'ManagerPerson' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Manager Person') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">





                                 <li class="slide">
                                    <a href="{{ route('ManagerPerson.index') }}" class="side-menu__item">{{ __('Manager Person') }}</a>
                                </li>






                            </ul>
                        </li>


                        <li class="slide has-sub {{ request()->segment(2) == 'ManagerCompany' ? 'active' : '' }}">
                            <a href="javascript:void(0);" class="side-menu__item">
                                <span class="shape1"></span>
                                <span class="shape2"></span>
                                <i class="ti-wallet side-menu__icon"></i>
                                <span class="side-menu__label">{{ __('Manager Company') }}</span>
                                <i class="fe fe-chevron-right side-menu__angle"></i>
                            </a>
                            <ul class="slide-menu child1">





                                 <li class="slide">
                                    <a href="{{ route('ManagerCompany.index') }}" class="side-menu__item">{{ __('Manager Company') }}</a>
                                </li>




                            </ul>
                        </li>









                        <!-- End::slide -->
                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"> <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path> </svg></div>
                </nav>
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->
