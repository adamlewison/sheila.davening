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
                @if($item)

                    <h1 class="major">{{$item->prayer->category}}</h1>


                    <h2>{{$item->prayer->prayer}} - Nusach {{\App\Models\Item::NUSACH[$item->nusach]}}</h2>

                    <h3>
                        Thank you!
                    </h3>
                    <p>
                        We are so grateful to you, because of you, we will be able to record a high quality soundtrack of {{$item->prayer->prayer}}
                        in the {{\App\Models\Item::NUSACH[$item->nusach]}} nusach.
                    </p>
                @else
                    <h1 class="major">Success</h1>


                    <h2>Donation Complete</h2>

                    <h3>
                        Thank you!
                    </h3>
                    <p>
                        We are so grateful to you, thank you for your generous donation.
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
