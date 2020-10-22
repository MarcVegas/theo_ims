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
            <b>The reports tab is a useful page where you can view tabular data of orders, products, 
                transactions, and deposits. These data can be exported into pdf that ready for printing. The 
                exported files can be found in the downloads folder.</b>
        <br>
        <h2>Store</h2>
        <h3 class="ui brown header" id="store"># Product</h3>
            <b>The products tab is where you can manage the products you sell. Here you can perform Create, 
                Read, Update, and Delete (CRUD) operations. All information about a product can be viewed and 
                edited here. You can also easily view products that are out of stock in this tab.</b>

        <div class="ui horizontal segments">
            <div class="ui inverted teal center aligned padded segment">
                <i class="lightbulb large icon"></i>
            </div>
            <div class="ui segment">
                Some operations such as deleting a product may be unavailable for certain reasons. 
                Learn why by clicking <a href="#nodelete">here</a>.
            </div>
        </div>
        <h3 class="ui brown header" id="customer"># Customer</h3>
            <b>The customers tab is where you can manage your customers information. Similar to the products tab, 
                the customers tab has full CRUD operations. Viewing a specific customer's profile will give you more 
                information like recent credit transactions. An order button will also be available that will lead you 
                to the <a href="#shop">shop</a> section.</b>
        <div class="ui horizontal segments">
            <div class="ui inverted teal center aligned padded segment">
                <i class="lightbulb large icon"></i>
            </div>
            <div class="ui segment">
                Some operations such as deleting a customer may be unavailable for certain reasons. 
                Learn why by clicking <a href="#nodelete">here</a>.
            </div>
        </div>
        <h3 class="ui brown header" id="supplier"># Supplier</h3>
            <b>The supplier tab is where you can manage your suppliers. It has full CRUD functionality and viewing a 
                supplier's products. A button to order from the selected supplier to restock your inventory.</b>
        <div class="ui horizontal segments">
            <div class="ui inverted teal center aligned padded segment">
                <i class="lightbulb large icon"></i>
            </div>
            <div class="ui segment">
                Some operations such as deleting a supplier may be unavailable for certain reasons. 
                Learn why by clicking <a href="#nodelete">here</a>.
            </div>
        </div>
        <h3 class="ui brown header" id="transaction"># Transaction</h3>
            <b>The transactions tab is where you can view all the transactions made by customers. Unlike the the products 
                tab for example, you cannot delete or update transaction records. This is to prevent any discrepancies that 
                may arise from manipulating such records. Viewing a transaction will reveal more details about a transaction 
                such as recent deposits for credit transactions and ordered items.
                <br><br>
                You can also generate a printable invoice using the print invoice button here.
            </b>
        <br>
        <h2>Administration</h2>
        <h3 class="ui brown header" id="profile"># Profile</h3>
            <b>The profile tab is where you can view and manage your administrator account and your 
                business information. Your business information will appear in any invoice you generate.
            </b>
        <h3 class="ui brown header" id="setting"># Setting</h3>
        <b>The settings tab is where you can add product categories, flushing the app's cache, and changing your 
            password. Changing password requires you to enter your email address which will receive the password reset link. 
            This process requires an internet connection. 
            <br>
        </b>
        <div class="ui horizontal segments">
            <div class="ui inverted teal center aligned padded segment">
                <i class="lightbulb large icon"></i>
            </div>
            <div class="ui segment">
                Flushing the app's cache will rerun all queries and might slow down the app. Only do this when necessary
            </div>
        </div>
        <h3 class="ui brown header" id="myorders"># My Orders</h3>
        <b>This tab is exclusively for orders made to suppliers. The functions are similar to that of the transactions tab.
        </b>
        <h2>Other</h2>
        <h3 class="ui brown header" id="expense"># Expense Tracker</h3>
            <b> This tab allows you to record your business expenses. These expenses will be used to substract 
                from the gross total income. Please note that any orders from suppliers are automatically recorded as 
                a business expense. So you don't need to re-enter the supplier order amount into the expense tracker.
            </b>
        <h3 class="ui brown header" id="quickorder"># Quick Order</h3>
            <b> The quick order button allows you to make orders without creating a customer account. This is best used for 
                non-reseller customers or one-time buyers. A customer ID will automatically be generated (e.g. Customer15345). 
                It should be noted that these type of customers cannot be edited and will not appear in the customers tab but their 
                orders will be recorded. 
            </b>
        <br>
        <h1>FAQ</h1>
        <h3 class="ui brown header" id="cache"># What is a cache?</h3>
            <b> In computing, a cache is a hardware or software component that stores data so that future requests for that data can be served faster;
                 the data stored in a cache might be the result of an earlier computation or a copy of data stored elsewhere. The system uses it 
                to quickly fetch query results from the database which improves the app's speed and performance. However, since the data doesn't come 
                directly from the database some values are not up to date. The system however only stores cache for 24 hours and destroy the cache and 
                fetches new data from the database automatically if it detects an item has been added or updated. For the most 
                part you don't need to manage these things unless you really want to.
            </b>
        <h3 class="ui brown header" id="nodelete"># Why can't I delete some products, customers, or supplier? </h3>
            <b>
                Some of these may have important records associated with them or have conditions that have to be met before it can be 
                deleted. For example, you cannot delete a customer that still has an outstanding balance from a credit transaction or 
                a supplier that still has products associated with it.
            </b>
        <h3 class="ui brown header" id=""># Why is saving a product or customer with an image slow? </h3>
            <b>
                This may be caused by an image with a large file size and so the system is taking time to process the image.
            </b>
        <h3 class="ui brown header" id=""># I found a bug in the system or an unexpected fatal error. What do I do? </h3>
            <b>
                Please contact the developer immediately. Contact details can be found <a href="#dev">here</a>.
            </b>
        <h3 class="ui brown header" id=""># Are records I delete gone forever?</h3>
            <b>
                Yes and no, some records are "soft deleted" so that order and transaction records can still reference then and 
                avoid errors when fetching info. For example, if a reseller account were to be deleted, the record is removed from the 
                customer management tab and will no longer be able to perform orders but some of the resellers data is kept around so that 
                past transaction records can still reference his/her name.
            </b>
        <h3 class="ui brown header" id=""># Can I recover these records?</h3>
            <b>
                Technically yes, but you will have to perform an sql query through a terminal or use the database administrator GUI but 
                this is not recommended if you don't have knowledge in performing sql commands or have experience in managing an SQL database. 
                You can just create a new product/customer/supplier instead and since a new ID is generated every time you create one, you can 
                name the product/customer/supplier with the same name as the deleted record and face no issues.
            </b>
        <h3 class="ui brown header" id=""># How to backup database?</h3>
            <b>
                A backup of the database can be made by going to <a href="http://localhost/phpmyadmin/db_export.php?db=theo_ims" target="_blank">this link</a>. Press the <b>Go</b> button at the bottom and wait for the database to be 
                downloaded. Do not touch or press any other button except the ones stated above. After the download is finished you can now 
                upload the file with the extension .sql to a flashdrive or cloud storage like Google Drive
            </b>
        <br>
        <h2 id="dev">DEVELOPER CONTACT</h2>
        <div class="ui raised very padded segment">
            <div class="ui stackable grid">
                <div class="five wide column">
                    <img class="ui circular image" src="/storage/images/profile.jpg" alt="">
                </div>
                <div class="eleven wide column">
                    <h1>Hi, I'm Omar</h1>
                    <b>I'm a freelance web developer that's passionate about making well designed 
                        applications for my clients. I also dabble in graphic art and UI/UX Design. If you 
                        have a business need or idea that requires my skills. Contact me and get a price qoute.
                    </b>
                    <br><br>
                    <div class="ui horizontal list">
                        <div class="item">
                            <div class="header"><i class="paper plane violet icon"></i> Telegram</div>
                            0929-554-8261
                        </div>
                        <div class="item">
                            <div class="header"><i class="thumbs up blue icon"></i> Facebook</div>
                            Marc Vegas
                        </div>
                        <div class="item">
                            <div class="header"><i class="envelope red icon"></i> Email</div>
                            marcvegas15.oc@gmail.com
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </div>
@endsection