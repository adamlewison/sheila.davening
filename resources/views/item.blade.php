<x-main-layout>

    <!-- Header -->
    <header id="header">
        <a href="/" class="title">Davening Project</a>
        <nav>
            <!--
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="generic.html" class="active">Generic</a></li>
                <li><a href="elements.html">Elements</a></li>
            </ul>
            -->
        </nav>
    </header>

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Main -->
        <section id="main" class="wrapper">

            <div class="inner">
                <h1 class="major">Sponsor a Tefillah</h1>
                <h2>{{$item->prayer->prayer}} - Nusach {{\App\Models\Item::NUSACH[$item->nusach]}}</h2>

                @if($item->available())
                    <h3>
                        You are almost there!
                    </h3>
                    <p>
                        We are so excited that you are going to be purchasing the recording of {{$item->prayer->prayer}} for the
                        {{\App\Models\Item::NUSACH[$item->nusach]}} Nusach! Please tell us your name (You can remain anonymous if you want).
                        And then proceed with the payment using the button below.
                    </p>

                    <div>
                        <form method="post" action="/items/{{$item->id}}">
                            @csrf

                            <div>
                                <!-- Validation Errors -->
                                <div style="color: red">
                                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                </div>

                                <h2>Your Details</h2>
                                <hr>
                            </div>

                            <div class="fields">
                                <div class="field half">
                                    <label for="name">First Name</label>
                                    <input type="text" name="first_name" id="name" />
                                </div>
                                <div class="field half">
                                    <label for="name">Last Name</label>
                                    <input type="text" name="last_name" id="name" />
                                </div>
                                <div class="field ">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" />
                                </div>
                            </div>

                            <div>
                                <h2>Honour Details</h2>
                                <hr>
                            </div>

                            <div class="fields">

                                <div class="field ">
                                    <label for="sponsor_by">This Honour is provided by</label>
                                    <input type="text" name="sponsor_by" />
                                </div>

                                <div class="field ">
                                    <label for="merit_of">This Honour is for the merit of</label>
                                    <input type="text" name="merit_of" />
                                </div>

                                <div class="field ">
                                    <input type="checkbox" name="show_on_app" checked id="show_on_app"/>
                                    <label for="show_on_app">Show honourship details on the app</label>
                                </div>
                            </div>
                            <ul class="actions">
                            <!--
                            <li><a href="" class="button primary submit">Pay R{{$item->price}}</a></li>

                            <li><a href="" class="submit">
                                    <img src="/images/walletdoc-pay.png" alt="" width="250px">
                                </a></li>
                                 -->
                                <li>
                                    <a href="" class="submit">
                                        <img src="/images/walletdoc-pay.png" alt="" width="250px">
                                    </a>
                                </li>
                            </ul>
                        </form>
                    </div>
                @else
                    <h3>Our Server is confused</h3>

                    <p>
                        It seems that someone has recently attempted to sponsor this tefillah. Perhaps this was you!
                    </p>

                    <p>
                        If you think this was you, please get in touch with Sheila Valentini (Click <b>Get in Touch</b> on the
                        <a href="/">Home page</a>).
                    </p>

                    <p>
                        However, if you have not previously tried to sponsor this tefillah then it probably was not you and that means someone else
                        has taken the opportunity to sponsor this tefillah. Quickly go to the <a href="/">Home page</a> where you can choose a different tefillah to sponsor!
                    </p>
                @endif
            </div>
        </section>


    </div>

    <!-- Footer -->
    <footer id="footer" class="wrapper alt">
        <div class="inner">
            <ul class="menu">
                <li>&copy; All rights reserved.</li><li></li>
            </ul>
        </div>
    </footer>

</x-main-layout>
