<x-main-layout>

    <!-- Header -->
    <header id="header">
        <a href="/" class="title">Tefillah</a>
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
                <h1 class="major">{{$item->prayer->category}}</h1>
                <h2>{{$item->prayer->prayer}} - Nusach {{\App\Models\Item::NUSACH[$item->nusach]}}</h2>

                <h3>
                    You are almost there!
                </h3>
                <p>
                    We are so excited that you are going to be sponsoring the recording of {{$item->prayer->prayer}} for the
                    {{\App\Models\Item::NUSACH[$item->nusach]}} Nusach! Please tell us your name (You can remain anonymous if you want).
                    And then proceed with the payment using the button below.
                </p>

                <div>
                    <form method="post" action="/items/{{$item->id}}">
                        @csrf
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
                        <ul class="actions">
                            <li><a href="" class="button submit">Pay R{{$item->price}}</a></li>
                        </ul>
                    </form>
                </div>
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
