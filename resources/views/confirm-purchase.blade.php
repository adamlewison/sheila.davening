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
                <h1 class="major">Purchase Confirmation</h1>
                <span class="image fit"><img src="images/girl_davening_1.jpg" alt="" /></span>

                <div>
                    <form method="post" action="#">
                        <div class="fields">
                            <div class="field half">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" />
                            </div>
                            <div class="field half">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" />
                            </div>
                            <div class="field">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" rows="5"></textarea>
                            </div>
                        </div>
                        <ul class="actions">
                            <li><a href="" class="button submit">Send Message</a></li>
                        </ul>
                    </form>
                    <?php
                        # $payfast = \App\Services\PayfastService::data(100);
                    ?>

                    <form action="{{ $payfast['url'] }}" method="post">
                        @foreach($payfast['form_input'] as $k => $v)
                            <input type="hidden" name="{{$k}}" value="{{$v}}">
                        @endforeach
                            <input type="submit" value="Pay">
                    </form>


                </div>
                <p>Donec eget ex magna. Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, fergiat. Pellentesque in mi eu massa lacinia malesuada et a elit. Donec urna ex, lacinia in purus ac, pretium pulvinar mauris. Curabitur sapien risus, commodo eget turpis at, elementum convallis elit. Pellentesque enim turpis, hendrerit tristique.</p>
                <p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Pellentesque venenatis dolor imperdiet dolor mattis sagittis. Praesent rutrum sem diam, vitae egestas enim auctor sit amet. Pellentesque leo mauris, consectetur id ipsum sit amet, fersapien risus, commodo eget turpis at, elementum convallis elit. Pellentesque enim turpis, hendrerit tristique lorem ipsum dolor.</p>
            </div>
        </section>


    </div>

    <!-- Footer -->
    <footer id="footer" class="wrapper alt">
        <div class="inner">
            <ul class="menu">
                <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
            </ul>
        </div>
    </footer>

</x-main-layout>
