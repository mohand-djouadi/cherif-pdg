<style>

    .wrapper {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin: 0 auto;
        width: 90%;
    }

    .card_project {
        width: 280px;
        height: 360px;
        background: #fff;
        display: flex;
        align-items: flex-end;
        padding: 2rem 1rem;
        position: relative;
        transition: 0.5s all ease-in-out;
        margin-bottom: 2rem;
    }

    .card_project:hover {
        transform: translateY(-10px);
    }

    .card_project::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(13, 36, 63, 0.3), rgba(13, 36, 63, 1));
        z-index: 2;
        opacity: 0;
        transition: 0.5s all;
    }

    .card_project:hover::before {
        opacity: 1;
    }

    .card_project img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0;
        left: 0;
    }

    .card_project .info {
        position: relative;
        color: #fff;
        z-index: 3;
        opacity: 0;
        transform: translateY(30px);
        transition: 0.5s all;
    }

    .card_project:hover .info {
        opacity: 1;
        transform: translateY(0);
    }

    .card_project .info h1 {
        line-height: 40px;
        margin-bottom: 10px;
    }

    .card_project .info p {
        font-size: 15px;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .card_project .info .btn {
        background: #fff;
        padding: 0.5rem 1rem;
        color: #000;
        font-size: 12px;
        cursor: pointer;
        border-radius: 20px;
        text-decoration: none;
        font-weight: bold;
        transition: .4s ease-in-out;
    }

    .card_project .info .btn:hover {
        background: #04346b;
        color: #fff;
        box-shadow: 0 7px 10px rgba(0, 0, 0, 0.5);
    }

    .card_project .info .btn2 {
        background: #fff;
        padding: 4px 0px;
        color: #000;
        font-size: 12px;
        cursor: pointer;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        transition: .4s ease-in-out;
    }

    .card_project .info .btn2:hover {
        background: #04346b;
        color: #fff;
        box-shadow: 0 7px 10px rgba(0, 0, 0, 0.5);
    }
</style>

<section id="services" class="services section-bg pt-3">
 <!-- Section Title -->
 <div class="container section-title" data-aos="fade-up">
    <div class="section-header">
        <h2> NOS PROJETS</h2>
    </div>

    <p>  <a  href="/projets" class=" stretched-link"><span > Voir plus de projets </span>&nbsp;<i class="bi bi-arrow-right ml-4 mr-4"></i></a></p>
 </div><!-- End Section Title -->
    <div class="container  mt-5" data-aos="fade-up">
        {{-- <div class="section-header">
            <h2> NOS PROJETS</h2>
        <p>  <a  href="/projets" class=" stretched-link"><span > Voir plus de projets </span>&nbsp;<i class="bi bi-arrow-right ml-4 mr-4"></i></a></p>

        </div> --}}
        <div class="row gy-4">

            <div class="row">
                <script>
                    var pro = @json($pro);

                    // console.log(pro);
                </script>
                @foreach ($pro as $projet)
                    <div class="col-12 col-md-6 col-lg-3 d-flex justify-content-center  ">
                        <div class="card_project">
                            <img src="{{ asset('' . $projet->imgCouverture2) }}" alt="">
                            <div class="info w-100">
                                <h1>{{ optional($projet->filiale)->sigle_commercial ?? 'Filiale inconnue' }} :</h1>
                                <p>{{ $projet->intitule }}</p>
                                <div class="d-flex justify-content-between w-100">
                                    <a href="{{'/projets/'.$projet->id}}" class="btn">Lire la suite</a>
                                    <a href="{{$projet->localisation}}"  target="_blank">  <i class="bi bi-geo-alt fs-4  btn2"></i> </a>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

</section><!-- End CTC en chiffres Section -->
