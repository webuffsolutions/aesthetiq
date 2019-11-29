var $ = jQuery.noConflict();

$(".all-products").on("click", function(e) {
    $(this).addClass("active");

    $(".collapse.show").each(function() {
        $(this).collapse("hide");
    });

    localStorage.setItem("current-product", "all-products");

    $('#single-product-content').css('display', 'none');
    displayAllProducts();
});

function clickProductCategory(e) {
    window.scrollTo(0, 60);
    var productSlug = $(e.target).data("id");
    $("span." + productSlug).addClass("active");
    $("span,a")
        .not("." + productSlug)
        .removeClass("active");

    if (productSlug !== undefined) {

        $('#single-product-content').css('display', 'none');
        displayProductCategoryItems(productSlug);

        $(".collapse.show").each(function() {
            $(this).collapse("hide");
        });

        // set selected option in dropdown
        $('select#selectDropdownCategory').val(productSlug);
    } else {
        $('select#selectDropdownCategory').val('all-products');
    }
}

$(document).ready(function() {
    $(window).scrollTop(0);

    products_settings.permalink == 'our-products' ? displayAllProducts() : '';

    // caret is clicked
    $(".collapse").on("show.bs.collapse", function(e) {
        $("span." + e.target.id).addClass("active");
        
        $("span,a").not("." + e.target.id)
        .removeClass("active");

        localStorage.setItem("current-product", e.target.id);

        $(".collapse.show").each(function() {
            $(this).collapse("hide");
        });

        $(".all-products").removeClass("active");
    });

    $(".collapse").on("hide.bs.collapse", function(e) {
        // $("span." + e.target.id).removeClass("active");
    });

    var current = localStorage.getItem("current-product");

    if (current) {
        if (current == "all-products") {
            $(".all-products").addClass("active");
        } else {
            $("." + current).addClass("active");
            $("." + current + "-collapse").addClass("collapse show");
        }
    }

    if (!current) {
        $(".all-products").addClass("active");
        localStorage.setItem("current-product", "all-products");
    }
});

function displayAllProducts() {
    displayProductsPageLoader();

    $.ajax({
        url: products_settings.site_url + "/wp-json/aesthetiq-api/v1/products",
        type: "GET",
        dataType: "json",
        success: function(res) {

            console.log(res);

            div = "";
            res.product_category.forEach(myProductsFunction);

            function myProductsFunction(item, index, arr) {
                var thumbnailUrl =
                    products_settings.site_url +
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
                    '<div class="row no-gutters pt-1 pb-4">';

                if (arr[index].products) {
                    for (var x = 0; x < arr[index].products.length; x++) {
                        var productThumbnail =
                            products_settings.site_url +
                            "/wp-content/themes/AesthetiQ-v1/assets/images/logo/login-logo.jpg";
                        if (arr[index].products[x].thumbnail_url) {
                            productThumbnail =
                                arr[index].products[x].thumbnail_url;
                        }

                        div +=
                            '<div class="col-md-4 col-6 pb-4">' +
                            `<a class="text-decoration-none" href="${arr[index].products[x].permalink}">` +
                                `<div class="d-flex justify-content-start">` +
                                    `<img class="img-fluid d-inline-block mr-2 rounded" src="${productThumbnail}" width="50" height="50">` +
                                    `<span class="text-gold-brown align-self-center" style="font-size: 15px;">${arr[index].products[x].product_name}</span>` +
                                `</div>` +
                            "</a>" +
                            "</div>";
                    }
                }

                div += "</div>" + "</div>" + "</div>";
            }

            $("#products-content")
                .empty()
                .append(div);
        },
        error: function(err) {
            console.log(err);
        }
    });
}

function displayProductCategoryItems(productSlug) {
    displayProductsPageLoader();

    $.ajax({
        url: products_settings.site_url + `/wp-json/aesthetiq-api/v1/specific-product/${productSlug}`,
        type: "GET",
        dataType: "json",
        success: function(res) {
            console.log(res);

            var categoryThumbnailUrl = products_settings.site_url + "/wp-content/uploads/2019/11/auto-draft-3-700x250.jpg";

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
                            '<div class="row no-gutters pt-1 pb-4">';

                            if (res.products) {
                                for (var x = 0; x < res.products.length; x++) {

                                    var productThumbnailUrl = products_settings.site_url + "/wp-content/themes/AesthetiQ-v1/assets/images/logo/login-logo.jpg";

                                    if (res.products[x].thumbnail_url) {
                                        productThumbnailUrl = res.products[x].thumbnail_url;
                                    }
                                    
                                    div+=
                                        '<div class="col-md-4 col-6 pb-4">' +
                                            `<a class="text-decoration-none" href="${res.products[x].permalink}">` +
                                                `<div class="d-flex justify-content-start">` +
                                                    `<img class="img-fluid d-inline-block mr-2 rounded" src="${productThumbnailUrl}" width="50" height="50">` +
                                                    `<span class="text-gold-brown align-self-center" style="font-size: 15px;">${res.products[x].product_name}</span>` +
                                                `</div>` +
                                            '</a>' +
                                        '</div>';
                                }

                                div+= '</div>' +
                                    '</div>' +
                                '</div>';

                                for (var x = 0; x < res.products.length; x++) {

                                    var productThumbnailUrl = products_settings.site_url + "/wp-content/themes/AesthetiQ-v1/assets/images/logo/login-logo.jpg";

                                    if (res.products[x].thumbnail_700x250_url) {
                                        productThumbnailUrl = res.products[x].thumbnail_700x250_url;
                                    }

                                    div+= 
                                        '<div class="card border-0 mb-4">' +
                                            '<div class="row no-gutters">' +
                                                '<div class="col-12 col-md-5">' +
                                                    `<div class="card-img-left" style="--image-url: url(${productThumbnailUrl})"></div>` +
                                                '</div>' +
                                                '<div class="col-12 col-md-7 bg-gray" style="min-height: 200px;">' +
                                                    '<span class="card-block">' +
                                                        `<h5 class="card-title text-white bg-pink pl-3 pt-2 pb-1">${res.products[x].product_name}</h5>` +
                                                        // `<p class="card-text px-3">Our Essential Treatments</p>` +
                                                        `<p class="card-text px-3">${res.products[x].excerpt}</p>` +
                                                        `<span class="mb-2" style="display: inline; position: absolute; bottom: 0;">` +
                                                            `<a href="${res.products[x].permalink}" 
                                                                class="action text-aq-brown font-weight-bold text-decoration-none px-3 pt-2 pb-3">` +
                                                                '<i class="fas fa-play fa-xs pr-1"></i>' +
                                                                '<span>VIEW DETAILS</span>' +
                                                            `</a>` +
                                                        `</span>` +
                                                    '</span>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>';
                                }
                            }
        
            $("#products-content")
                .empty()
                .append(div);

        },
        error: function(err) {
            console.log(err);
        }
    });
}

function displayProductsPageLoader() {
    var div = "";
    div +=
        '<div class="text-center"><img src="' +
        products_settings.site_url +
        '/wp-content/themes/AesthetiQ-v1/assets/images/loader.gif" /></div>';

    $("#products-content")
        .empty()
        .append(div);
}