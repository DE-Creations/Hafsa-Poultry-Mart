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

                <li class="nav-item {{ request()->routeIs('invoice*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('invoice.create') }}">
                        <i class="icon-support_agent"></i>Invoice
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('customers*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('customers.index') }}"><i
                            class="icon-supervised_user_circle"></i>Customers
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('stock*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('stock.index') }}">
                        <i class="icon-support_agent"></i>Stock
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('grn*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('grn.index') }}">
                        <i class="icon-support_agent"></i>GRN
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('suppliers*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('suppliers.index') }}">
                        <i class="icon-support_agent"></i>Suppliers
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('expenses*') ? 'active-link' : '' }}">
                    <a class="nav-link" href="{{ route('expenses.index') }}">
                        <i class="icon-support_agent"></i>Expenses
                    </a>
                </li>

                <li class="nav-item dropdown {{ request()->routeIs('reports*') ? 'active-link' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="icon-margin"></i>Reports
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('reports.invoice.index') }}"><span>Invoice</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('reports.expense.index') }}"><span>Expenses</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item"
                                href="{{ route('reports.profit_loss.index') }}"><span>Sales</span></a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('reports.profit_loss.index') }}"><span>Profit &amp;
                                    Loss</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
