<nav class="navbar navbar-expand-lg">
    <div class="container">
        <div class="offcanvas offcanvas-end" id="MobileMenu">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title semibold">Navigation</h5>
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="offcanvas">
                    <i class="icon-clear"></i>
                </button>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item {{ request()->routeIs('dashboard*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="icon-stacked_line_chart"></i>Dashboard
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('customers*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('customers.index') }}"><i
                            class="icon-supervised_user_circle"></i>Customers
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('invoice*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('invoice.index') }}">
                        <i class="icon-support_agent"></i>Invoice
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('grn*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('grn.index') }}">
                        <i class="icon-support_agent"></i>GRN
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('expenses*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('expenses.index') }}">
                        <i class="icon-support_agent"></i>Expenses
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="icon-drive_file_rename_outline"></i>Reports
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="form-inputs.html"><span>Expenses</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="form-checkbox-radio.html"><span>Profit &amp; loss</span></a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="icon-margin"></i> Plugins
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="apex.html"><span>Apex Graphs</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="morris.html"><span>Morris Graphs</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="editor.html"><span>Editor</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="calendar.html"><span>Calendar Daygrid
                                    View</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="calendar-external-draggable.html"><span>Calendar External
                                    Draggable</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="calendar-google.html"><span>Calendar
                                    Google</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="calendar-list-view.html"><span>Calendar List
                                    View</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="calendar-selectable.html"><span>Calendar
                                    Selectable</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="date-time-pickers.html"><span>Date Time
                                    Pickers</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="datatables.html"><span>Data Tables</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="maps.html"><span>Maps</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
