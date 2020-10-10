@extends('layouts.app')

@section('content')
@include('inc.navbar')
    <div class="ui text container">
        <br><br>
        <h1 class="ui teal header">
            IMS Knowledge Base
            <div class="ui sub header">
                A collection of questions, answers, and explanations that helps give better understanding 
                of the functions of Theo Inventory Management System.
            </div>
        </h1>
        <h2>General</h2>
        <h3 class="ui brown header" id="dashboard"># Dashboard</h3>
            <b>The dashboard gives you a quick view of several important information gathered 
                from records in the database such as number of orders, expenses, gross income, 
                and net income. It also includes data about best selling products and top 
                customers.</b>
        <div class="ui horizontal segments">
            <div class="ui inverted teal center aligned padded segment">
                <i class="lightbulb large icon"></i>
            </div>
            <div class="ui segment">
                Some of these results may be cached. So new data may not appear immediately. 
                Read the <a href="#cache">cache</a> section to know more.
            </div>
        </div>
        <h3 class="ui brown header" id="reports"># Reports</h3>
            The reports tab is a useful page where you can view tabular data of orders, products, 
            transactions, and deposits. These data can be exported into pdf that ready for printing. The 
            exported files can be found in the downloads folder.
        <br>
        <h2>Store</h2>
        <h3 class="ui brown header" id="store"># Product</h3>
        <div class="ui raised segment">
            <p>The products tab is where you can manage the products you sell. Here you can perform Create, 
                Read, Update, and Delete (CRUD) operations. All information about a product can be viewed and 
                edited here. You can also easily view products that are out of stock in this tab.

                <div class="ui horizontal segment">
                    <div class="ui inverted teal center aligned segment">
                        <i class="bulb icon"></i>
                    </div>
                    <div class="ui segment">
                        Some operations such as deleting a product may be unavailable for certain reasons. 
                        Learn why by clicking <a href="#">here</a>.
                    </div>
                </div>
            </p>
        </div>
        <h3 class="ui brown header" id="customer"># Customer</h3>
        <div class="ui raised segment">
            <p>The customers tab is where you can manage your customers information. Similar to the products tab, 
                the customers tab has full CRUD operations. Viewing a specific customer's profile will give you more 
                information like recent credit transactions. An order button will also be available that will lead you 
                to the <a href="#shop">shop</a> section.

                <div class="ui horizontal segment">
                    <div class="ui inverted teal center aligned segment">
                        <i class="bulb icon"></i>
                    </div>
                    <div class="ui segment">
                        Some operations such as deleting a customer may be unavailable for certain reasons. 
                        Learn why by clicking <a href="#">here</a>.
                    </div>
                </div>
            </p>
        </div>
        <h3 class="ui brown header" id="supplier"># Supplier</h3>
        <div class="ui raised segment">
            <p>The supplier tab is where you can manage your suppliers. It has full CRUD functionality and viewing a 
                supplier's products. A button to order from the selected supplier to restock your inventory. 

                <div class="ui horizontal segment">
                    <div class="ui inverted teal center aligned segment">
                        <i class="bulb icon"></i>
                    </div>
                    <div class="ui segment">
                        Some operations such as deleting a supplier may be unavailable for certain reasons. 
                        Learn why by clicking <a href="#">here</a>.
                    </div>
                </div>
            </p>
        </div>
        <h3 class="ui brown header" id="transaction"># Transaction</h3>
        <div class="ui raised segment">
            <p>The transactions tab is where you can view all the transactions made by customers. Unlike the the products 
                tab for example, you cannot delete or update transaction records. This is to prevent any discrepancies that 
                may arise from manipulating such records. Viewing a transaction will reveal more details about a transaction 
                such as recent deposits for credit transactions and ordered items.
                <br><br>
                You can also generate a printable invoice using the print invoice button here.
            </p>
        </div>
    </div>
@endsection