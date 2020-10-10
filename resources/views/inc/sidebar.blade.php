<div class="ui sidebar inverted vertical menu sidebar-menu" id="sidebar">
    <div class="item">
        <div class="header">General</div>
        <div class="menu">
            <a class="item" href="/home">
                <div><i class="icon tachometer alternate"></i>
                    Dashboard
                </div>
            </a>
            <a class="item" href="/reports">
                <div><i class="icon chart bar"></i>
                    Reports
                </div>
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">
            Store
        </div>
        <div class="menu">
            <a class="item" href="{{route('products.index')}}">
                <div><i class="boxes icon"></i>Products</div>
            </a>
            <a class="item" href="{{route('customers.index')}}">
                <div><i class="users icon"></i>Customers</div>
            </a>
            <a class="item" href="{{route('suppliers.index')}}">
                <div><i class="warehouse icon"></i>Supplier</div>
            </a>
            <a class="item" href="{{route('transactions.index')}}">
                <div><i class="handshake icon"></i>Transactions</div>
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">
            Administration
        </div>
        <div class="menu">
            <a class="item" href="{{route('profile.index')}}">
                <div><i class="user icon"></i>Profile</div>
            </a>
            <a class="item" href="/settings">
                <div><i class="cog icon"></i>Setting</div>
            </a>
            <a class="item" href="{{route('restock.index')}}">
                <div><i class="shopping cart icon"></i>My Orders</div>
            </a>
            <a class="item" href="{{route('notifications.index')}}">
                <div><i class="bell icon"></i>Notifications</div>
            </a>
        </div>
    </div>
    <div class="item">
        <div class="header">Other</div>
        <div class="menu">
            <a class="item" href="{{route('expenses.index')}}">
                <div><i class="icon money bill alternate"></i>
                    Expense Tracker
                </div>
            </a>
        </div>
    </div>
    <a class="item" href="/userguide">
        <div><i class="icon lightbulb"></i>
        User Guide
        </div>
    </a>
    <div class="item">
        <a class="ui blue fluid button" href="/quickorder">Quick Order</a>
    </div>
</div>