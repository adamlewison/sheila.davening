<!DOCTYPE HTML>

<html>
<head>
    <title>Davening</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
    <style>
        #prayer-category-list {
            text-align: center;
            font-size: x-large;
            color: white;
            font-weight: bold;
        }
        #prayer-category-list li a:hover {
            color: gray;
        }

        #prayer-category-list li.selected {
            color: orange;
        }

        .pagination-button {
            cursor: pointer;
            font-weight: bold;
            font-size: larger;
            transition: color 1s;
        }

        .pagination-button:hover {
            color: white;
        }

        a.button.ari {
            background-color: rgb(227, 103, 103);
        }

        a.button.ashkenaz {
            background-color: rgb(103, 201, 227);
        }
        ul.purchase li:first-child {
            border-radius: 0;
            padding-right: 0;
        }
        ul.purchase li:nth-child(2) {
            border-radius: 0;
            padding-left: 0;
        }

        ul.purchase li a.button {
            border-radius: 0;
        }
    </style>
</head>
<body class="is-preload">

<!-- Sidebar -->
<section id="sidebar">
    <div class="inner">
        <nav>
            <ul>
                <li><a href="#intro">Welcome</a></li>
                <li><a href="#one">Purchase a Tefillah</a></li>

                <!--
                <li><a href="#two">Donate</a></li>
                -->

                <li><a href="#three">Get in touch</a></li>
            </ul>
        </nav>
    </div>
</section>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Intro -->
    <section id="intro" class="wrapper style1 fullscreen fade-up">
        <div class="inner">
            <h1>The Davening Project</h1>
            <p>
                This website serves the creation of a davening app.
                The chinuch app is made by women for women to learn/improve their davening.
                We would like to partner with you by providing an opportunity to "purchase" a tefillah in honour of a loved one.
                Thank you for helping us make this happen, we hope that we will continue to develop according to the expressed requirements of our market.
            </p>
            <ul class="actions">
                <li><a href="#one" class="button scrolly">Purchase a Tefillah</a></li>
            </ul>
        </div>
    </section>

    <!-- One -->
    <section id="one" class="wrapper style2 spotlights">
        <div class="inner">
            <h1>Purchase a Tefillah</h1>
            <p>
                Find a Tefillah to purchase and see prices by selecting a category and navigating through the different options.
                When you have made your decision, select the Nusach - Ari or Ashkenaz - to proceed to the checkout page.
                If you are not able to select the desired nusach for your chosen prayer (and Nusach), it probably means that prayer has already been bought!
            </p>
            <ul class="actions fit" id="prayer-category-list">
                @foreach(\App\Models\Prayer::categories() as $cat)
                    <li data-category="{{$cat}}" onclick="set_category('{{$cat}}')"><a href="#{{$cat}}">{{$cat}}</a></li>
                @endforeach
            </ul>
            <hr>
            <div class="table-wrapper">

                <table>
                    <!--
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    -->
                    @foreach(\App\Models\Prayer::categories() as $cat)
                        <tbody data-category="{{$cat}}">
                            @foreach(\App\Models\Prayer::category($cat)->get() as $i => $prayer)
                                <tr data-index="{{$i}}">
                                    <th>{{$prayer->prayer}}</th>
                                    <td style="text-align: center; vertical-align: middle">
                                        <!--
                                        <img src="images/nusach-0.jpg" alt="" height="30px">
                                        -->
                                        <ul class="actions fit purchase" style="margin-bottom: 5px">
                                            @if($prayer->ari)
                                                @if($prayer->ari->purchased() || $prayer->ari->onHold())
                                                    <li><a href="#" class="button primary disabled">Ari</a></li>
                                                @else
                                                    <li><a href="items/{{$prayer->ari->id}}" class="button ari-purchase ari">Ari</a></li>
                                                @endif
                                            @else
                                                <li><a href="#" class="button primary disabled">Ari</a></li>
                                            @endif

                                            @if($prayer->ashkenaz)
                                                @if($prayer->ashkenaz->purchased() || $prayer->ashkenaz->onHold())
                                                        <li><a href="#" class="button primary disabled">Ashkenaz</a></li>
                                                @else
                                                    <li><a href="items/{{$prayer->ashkenaz->id}}" class="button ashkenaz">Ashkenaz</a></li>
                                                @endif
                                            @else
                                                    <li><a href="#" class="button primary disabled">Ashkenaz</a></li>
                                            @endif
                                        </ul>
                                    </td>
                                    <td style="text-align: right">R{{$prayer->price}}.00</td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endforeach
                    <tfoot>
                    <tr>
                        <td colspan="1" onclick="prev()" class="pagination-button">
                            <li class="icon fa fa-arrow-left"></li>
                            Previous
                        </td>
                        <td colspan="1"></td>
                        <td style="text-align: right" onclick="next()" class="pagination-button">

                            Next
                            <li class="icon fa fa-arrow-right"></li>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!--
        <section>
            <a href="#" class="image"><img src="images/pic01.jpg" alt="" data-position="center center" /></a>
            <div class="content">
                <div class="inner">
                    <h2>Sed ipsum dolor</h2>
                    <p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus.</p>
                    <ul class="actions">
                        <li><a href="generic.html" class="button">Learn more</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <a href="#" class="image"><img src="images/pic02.jpg" alt="" data-position="top center" /></a>
            <div class="content">
                <div class="inner">
                    <h2>Feugiat consequat</h2>
                    <p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus.</p>
                    <ul class="actions">
                        <li><a href="generic.html" class="button">Learn more</a></li>
                    </ul>
                </div>
            </div>
        </section>
        <section>
            <a href="#" class="image"><img src="images/pic03.jpg" alt="" data-position="25% 25%" /></a>
            <div class="content">
                <div class="inner">
                    <h2>Ultricies aliquam</h2>
                    <p>Phasellus convallis elit id ullamcorper pulvinar. Duis aliquam turpis mauris, eu ultricies erat malesuada quis. Aliquam dapibus.</p>
                    <ul class="actions">
                        <li><a href="generic.html" class="button">Learn more</a></li>
                    </ul>
                </div>
            </div>
        </section>
        -->
    </section>

    <!-- Two -->
    <!--
    <section id="two" class="wrapper style3 fade-up">
        <div class="inner">
            <h2>Make a donation</h2>
            <p>
                If you have already sponsored a prayer and are looking for another way to give to our cause. You can use this form to make a donations.
            </p>
            <form method="post" action="donate">
                @csrf
                <div class="fields">
                    <div class="field">
                        <label for="name">Donation Amount (ZAR)</label>
                        <input type="text" name="amount" id="amount" />
                    </div>
                    <div class="field half">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" />
                    </div>
                    <div class="field half">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" />
                    </div>
                </div>
                <ul class="actions">
                    <li><a href="" class="button submit">Donate</a></li>
                </ul>
            </form>
        </div>
    </section>
    -->

    <!-- Three -->
    <section id="three" class="wrapper style1 fade-up">
        <div class="inner">
            <h2>Get in touch</h2>
            <p>

            </p>
            <div class="split style1">
                <section>
                    <ul class="contact">

                        <li>
                            <h3>Organizer</h3>
                            <span>Sheila Valentini</span>
                        </li>
                    </ul>
                </section>
                <section>
                    <ul class="contact">

                        <li>
                            <h3>Email</h3>
                            <a href="mailto:sheilavalentini@cttorahhigh.com">sheilavalentini@cttorahhigh.com</a>
                        </li>
                        <li>
                            <h3>Phone</h3>
                            <span>+27 (0) 73 341 9738</span>
                        </li>
                        <!--
                        <li>
                            <h3>Social</h3>
                            <ul class="icons">
                                <li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
                                <li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
                                <li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
                                <li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
                                <li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
                            </ul>
                        </li>
                        -->
                    </ul>
                </section>
            </div>
        </div>
    </section>

</div>

<!-- Footer -->
<footer id="footer" class="wrapper style1-alt">
    <div class="inner">
        <ul class="menu">
            <li>&copy; All rights reserved.</li>
            <!--<li>Design: <a href="http://html5up.net">HTML5 UP</a></li>-->
        </ul>
    </div>
</footer>

<!-- Scripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/browser.min.js"></script>
<script src="assets/js/breakpoints.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
<script>

    pagination_page = 1;
    items_per_page = 5;
    start = (pagination_page - 1) * items_per_page;
    end = (pagination_page) * items_per_page;
    category = 'Shacharit';
    rows = $('tbody[data-category="' + category + '"] tr')

    $(function () {
        set_category(category)
        refresh_table_view()
    })

    function refresh_table_view() {
        rows.each( (i, x) => {
            (start <= i && i < end) ? $(x).show() : $(x).hide();
        });
    }

    function set_category(cat) {
        category = cat
        pagination_page = 1;
        rows = $('tbody[data-category="' + category + '"] tr')
        refresh_table_view()
        //console.log(.length)

        $('tbody[data-category]').each( (i, x) => {
            $(x).attr('data-category') == category ? $(x).show() : $(x).hide()
        })

        $('li[data-category]').each( (i, x) => {
            $(x).attr('data-category') == category ? $(x).addClass('selected') : $(x).removeClass('selected')
        })
    }

    function next() {
        if (end < rows.length) {
            pagination_page++;
            refresh_table_view()
        } else {
            console.log("No more")
        }
    }

    function prev() {
        if (pagination_page > 1) {
            pagination_page--;
            refresh_table_view()
        } else {
            console.log("No more")
        }
    }

    function refresh_table_view() {
        start = (pagination_page - 1) * items_per_page;
        end = (pagination_page) * items_per_page;
        rows.each( (i, x) => {
            (start <= i && i < end) ? $(x).show() : $(x).hide();
        });
        console.log(pagination_page, start, end, rows.length)
    }
</script>
</body>
</html>
