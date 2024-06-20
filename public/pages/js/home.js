let id_el_list = "#product-preview";

function getData(){
    let url = baseUrl+'/api/tech';
    let payload = {
        '_limit': 3,
        '_page': 1,
    };

    axios.get(url,{params:payload},apiHeaders)
    .then(function(response) {
        console.log('[DATA] response..',response.data);
        let template = ``;
        (response.data.products).forEach((item) => {
            template += `
            <div class="single-hero-slider-7" onclick="location.href='`+baseUrl+`/tech/`+item.id+`'">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hero-content-wrap">
                                <div class="hero-text-7 mt-lg-5">
                                    <h6 class="mb-20">
                                        Latest from HomeTech
                                    </h6>
                                    <h1>`+breakWord(item.title)+`</h1>

                                    <div class="button-box section-space--mt_60">
                                        <a href="#" class="text-btn-normal font-weight--reguler font-lg-p">Discover now</a>
                                    </div>
                                </div>
                                <div class="inner-images">
                                    <div class="image-one">
                                        <img src="`+item.cover+`" width="250"
                                        class="img-fluid" alt="Image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
        });
        $(id_el_list).html(template);
        $(id_el_list).slick({
            dots: false,
            infinite: true,
            slideToShow: 1,
            slidesToScroll: 1,
            autoplay: false,
            prevArrow: '<span class="arrow-prv"><i class="icon-chevron-left"></i></span>',
            nextArrow: '<span class="arrow-next"><i class="icon-chevron-right"></i></span>',
            responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        slideToShow: 1,
                    }
                }
            ]
        });
    })
    .catch(function (error) {
        console.log('[ERROR] response..',error);
        Swal.fire({
            icon: 'error',
            width: 600,
            title: "Error",
            html: error.message,
            confimrButtonText: 'Ya',

        });
    });
}

$(function () {
    getData();
});