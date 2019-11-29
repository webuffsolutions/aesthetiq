var $ = jQuery.noConflict();

$(".all-products").on("click", function(e) {
    $(this).addClass("active");

    $(".collapse.show").each(function() {
        $(this).collapse("hide");
    });

    localStorage.setItem("current", "all-products");

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

        localStorage.setItem("current", e.target.id);

        $(".collapse.show").each(function() {
            $(this).collapse("hide");
        });

        $(".all-products").removeClass("active");
    });

    $(".collapse").on("hide.bs.collapse", function(e) {
        // $("span." + e.target.id).removeClass("active");
    });

    var current = localStorage.getItem("current");

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
        localStorage.setItem("current", "all-products");
    }
});

function displayAllProducts() {
    displayLoader();

    $("#products-content").empty();
}

function displayProductCategoryItems(productSlug) {
    displayLoader();

    alert(productSlug);
}

function displayLoader() {
    var div = "";
    div +=
        '<div class="text-center"><img src="' +
        products_settings.site_url +
        '/wp-content/themes/AesthetiQ-v1/assets/images/loader.gif" /></div>';

    $("#products-content")
        .empty()
        .append(div);
}