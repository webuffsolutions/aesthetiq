var $ = jQuery.noConflict();

$(".all-services").on("click", function(e) {
    $(this).addClass("active");

    $(".collapse.show").each(function() {
        $(this).collapse("hide");
    });

    localStorage.setItem("current", "all-services");

    $('#single-service-content').css('display', 'none');
    displayAllServices();
});

function clickCategory(e) {
    window.scrollTo(0, 60);
    var serviceSlug = $(e.target).data("id");
    $("span." + serviceSlug).addClass("active");
    $("span,a")
        .not("." + serviceSlug)
        .removeClass("active");

    if (serviceSlug !== undefined) {
        // $("#services-content").css("display", "none");
        // $("#other-services").css("display", "block");
        $('#single-service-content').css('display', 'none');
        displayServiceCategoryItems(serviceSlug);

        $(".collapse.show").each(function() {
            $(this).collapse("hide");
        });

        // set selected option in dropdown
        $('select#selectDropdownCategory').val(serviceSlug);
    } else {
        $('select#selectDropdownCategory').val('all-services');
    }
}

$(document).ready(function() {
    $(window).scrollTop(0);

    services_settings.permalink == 'our-services' ? displayAllServices() : '';

    // caret is clicked
    $(".collapse").on("show.bs.collapse", function(e) {
        $("span." + e.target.id).addClass("active");
        
        $("span,a").not("." + e.target.id)
        .removeClass("active");

        localStorage.setItem("current", e.target.id);

        $(".collapse.show").each(function() {
            $(this).collapse("hide");
        });

        $(".all-services").removeClass("active");
    });

    $(".collapse").on("hide.bs.collapse", function(e) {
        // $("span." + e.target.id).removeClass("active");
    });

    var current = localStorage.getItem("current");

    if (current) {
        if (current == "all-services") {
            $(".all-services").addClass("active");
        } else {
            $("." + current).addClass("active");
            $("." + current + "-collapse").addClass("collapse show");
        }
    }

    if (!current) {
        $(".all-services").addClass("active");
        localStorage.setItem("current", "all-services");
    }
});

// display all services
function displayAllServices() {
    displayLoader();

    $.ajax({
        url: services_settings.site_url + "/wp-json/aesthetiq-api/v1/services",
        type: "GET",
        dataType: "json",
        success: function(res) {
            div = "";
            res.service_category.forEach(myFunction);

            console.log(res);

            function myFunction(item, index, arr) {
                var thumbnailUrl =
                    services_settings.site_url +
                    "/wp-content/uploads/2019/11/auto-draft-3-700x250.jpg";
                if (arr[index].thumbnail_url) {
                    thumbnailUrl = arr[index].thumbnail_url;
                }

                div +=
                    '<div class="card border-0">' +
                    '<img class="img-fluid card-img-top border-bottom-green rounded"' +
                    `src="${thumbnailUrl}" />` +
                    '<div class="card-body px-0">' +
                    `<h2 class="text-aq-brown font-weight-bold text-uppercase">${arr[index].name}</h2>` +
                    `<p>${arr[index].description}</p>` +
                    '<div class="row pt-1 pb-4">';

                if (arr[index].services) {
                    for (var x = 0; x < arr[index].services.length; x++) {
                        var serviceThumbnail =
                            services_settings.site_url +
                            "/wp-content/themes/AesthetiQ-v1/assets/images/logo/login-logo.jpg";
                        if (arr[index].services[x].thumbnail_url) {
                            serviceThumbnail =
                                arr[index].services[x].thumbnail_url;
                        }

                        div +=
                            '<div class="col-md-4 col-6 pb-4">' +
                            `<a class="text-decoration-none" href="${arr[index].services[x].permalink}">` +
                            `<img class="img-fluid d-inline-block mr-2 rounded" src="${serviceThumbnail}" width="50">` +
                            `<span class="text-gold-brown">${arr[index].services[x].service_name}</span>` +
                            "</a>" +
                            "</div>";
                    }
                }

                div += "</div>" + "</div>" + "</div>";
            }

            $("#services-content")
                .empty()
                .append(div);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

// display specific service category
function displayServiceCategoryItems(serviceSlug) {
    displayLoader();

    $.ajax({
        url: services_settings.site_url + `/wp-json/aesthetiq-api/v1/specific-service/${serviceSlug}`,
        type: "GET",
        dataType: "json",
        success: function(res) {
            console.log(res);

            var categoryThumbnailUrl = services_settings.site_url + "/wp-content/uploads/2019/11/our-essential-treatments-700x250.jpg";

            if (res.data.thumbnail_url) {
                categoryThumbnailUrl = res.data.thumbnail_url;
            }

            div = "";
            div += 
                '<div class="card border-0">' + 
                    `<img class="img-fluid card-img-top border-bottom-green rounded" src="${categoryThumbnailUrl}" />` +
                    '<div class="card-body px-0">' +
                        `<h2 class="text-aq-brown font-weight-bold text-uppercase">${res.data.name}</h2>` +
                        `<p>${res.data.description}</p>` +
                            '<div class="row pt-1 pb-4">';

                            if (res.services) {
                                for (var x = 0; x < res.services.length; x++) {

                                    var serviceThumbnailUrl = services_settings.site_url + "/wp-content/themes/AesthetiQ-v1/assets/images/logo/login-logo.jpg";

                                    if (res.services[x].thumbnail_url) {
                                        serviceThumbnailUrl = res.services[x].thumbnail_url;
                                    }
                                    
                                    div+=
                                        '<div class="col-md-4 col-6 pb-4">' +
                                            `<a class="text-decoration-none" href="${res.services[x].permalink}">` +
                                                `<img class="img-fluid d-inline-block mr-2 rounded" src="${serviceThumbnailUrl}" width="50">` +
                                                `<span class="text-gold-brown text-uppercase" style="font-size: 15px;">${res.services[x].service_name}</span>` +
                                            '</a>' +
                                        '</div>';
                                }

                                div+= '</div>' +
                                    '</div>' +
                                '</div>';

                                for (var x = 0; x < res.services.length; x++) {

                                    var serviceThumbnailUrl = services_settings.site_url + "/wp-content/themes/AesthetiQ-v1/assets/images/logo/login-logo.jpg";

                                    if (res.services[x].thumbnail_700x250_url) {
                                        serviceThumbnailUrl = res.services[x].thumbnail_700x250_url;
                                    }

                                    div+= 
                                        '<div class="card border-0 mb-4">' +
                                            '<div class="row no-gutters">' +
                                                '<div class="col-12 col-md-5">' +
                                                    `<div class="card-img-left" style="--image-url: url(${serviceThumbnailUrl})"></div>` +
                                                '</div>' +
                                                '<div class="col-12 col-md-7 bg-gray" style="min-height: 200px;">' +
                                                    '<span class="card-block">' +
                                                        `<p class="card-title text-white bg-pink px-3 pt-2">${res.services[x].service_name}</p>` +
                                                        // `<p class="card-text px-3">Our Essential Treatments</p>` +
                                                        `<p class="card-text px-3">${res.services[x].excerpt}</p>` +
                                                        `<span class="mb-2" style="display: inline; position: absolute; bottom: 0;">` +
                                                            `<a href="${res.services[x].permalink}" 
                                                                class="action text-aq-brown font-weight-bold text-decoration-none px-3 pt-2 pb-3">` +
                                                                '<i class="fas fa-play fa-xs pr-1"></i>' +
                                                                '<span>VIEW DETAILS</span>' +
                                                            `</a>` +
                                                            `<a href="${services_settings.site_url}/book-your-appointment" 
                                                                class="action text-aq-brown font-weight-bold text-decoration-none px-3 pt-2 pb-3">` +
                                                                '<i class="fas fa-play fa-xs pr-1"></i>' +
                                                                '<span>BOOK APPOINTMENT</span>' +
                                                            `</a>` +
                                                        `</span>` +
                                                    '</span>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                }
                            }
        
            $("#services-content")
                .empty()
                .append(div);

        },
        error: function(err) {
            console.log(err);
        }
    });
}

// select dropdown category
$('#selectDropdownCategory').on('change', function(e) {
    $('#single-service-content').css('display', 'none');

    var categorySlug = this.value;

    if (categorySlug == 'all-services') {
        displayAllServices();
    } else {
        displayServiceCategoryItems(categorySlug);
    }
});

function displayLoader() {
    var div = "";
    div +=
        '<div class="text-center"><img src="' +
        services_settings.site_url +
        '/wp-content/themes/AesthetiQ-v1/assets/images/loader.gif" /></div>';

    $("#services-content")
        .empty()
        .append(div);
}
