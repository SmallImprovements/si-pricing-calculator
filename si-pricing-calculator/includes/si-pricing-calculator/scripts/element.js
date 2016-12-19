

jQuery(document).ready(function(){ 
    //import {getPricing, getNormalizedUserCount} from '../utilities/getPricing';
    // defaults 
    var forProfitFreeLimit = 10;
    var nonProfitFreeLimit = forProfitFreeLimit * 2;

    var levels = [
        {
            until: 200,
            price: 6
        },
        {
            until: 500,
            price: 4
        },
        {
            until: 1000,
            price: 3
        },
        {
            until: 2000,
            price: 2
        }
        ],
        yearDiscount = 10, // in months
        twoYearDiscount = 18; // in months

    // defaults end

    function getPricing(users, nonprofit) {
        users = getNormalizedUserCount(users, nonprofit);

        var price = levels.reduce(function (prev, current, index, array) {
            var prevLevel = array[index - 1],
                prevLimit = prevLevel ? prevLevel.until : 0,
                upperLimit = Math.min(users, current.until);

            if (users < prevLimit) {
                return prev;
            }

            return (upperLimit - prevLimit) * current.price + prev;
        }, 0) / (nonprofit ? 2 : 1);

        return {
            monthly: formatPrice(price),
            yearly: formatPrice(price * yearDiscount),
            biyearly: formatPrice(price * twoYearDiscount),
            free: users <= getFreeLimit(nonprofit),
            discountApplied: users > levels[0].until,
            volumePricing: users > levels[levels.length-1].until
            //discountApplied: users > _.head(levels).until,
            //volumePricing: users > _.last(levels).until
        };
    }

    function formatPrice(price) {
        if (price.toString().indexOf('.') !== -1) {
            if (price > 100) {
                price = Math.round(price);
            } else {
                price = price.toFixed(2);
            }
        }
        return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    function getFreeLimit(nonprofit) {
        return nonprofit ? nonProfitFreeLimit : forProfitFreeLimit;
    }

    function getNormalizedUserCount(count, nonprofit) {
        var minimumLevel = 25;
        return count > getFreeLimit(nonprofit) && count < minimumLevel ?
            minimumLevel :
            count;
    }

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    var app = {};
    app.modules = {};
    app.events = jQuery({});
    app.modules.pricingCalculator = {
        //el: '#pricing-calculator',
        el: '[data-component="PricingCalculator"]',

        init: function () {
            if (jQuery(this.el).length) {
                this.setPrice = this.setPrice.bind(this);
                this.setInput = this.setInput.bind(this);
                this.input = this.input.bind(this);

                //_.bindAll(this, 'setPrice', 'setInput', 'input');
                this.cacheEls();
                this.bindEvents();
                this.setPrice();
                this.setButtonVisibility();
            }
            
        },

        setButtonVisibility: function() {
            var self = this;
            this.$freePlanButton.hide();
            this.$trialButton.show();
            this.$buyButton.hide();
            function waitForElement(){
                if(typeof window.SI._currentUser.id !== "undefined"){
                    var isLoggedIn = window.SI._currentUser.id;
                    var company = window.SI._currentUser.company;
                   
                    
                    if(isLoggedIn) {
                        self.$freePlanButton.hide();
                        self.$trialButton.hide();
                        self.$buyButton.show();
                        self.$contactButton.hide();
                    }

                    // if (company != null && currentUser != null
                    //     && currentUser.hasBasicHR() && company.getPlan() == 0) {
                    //     self.$buyButton.show();
                    // }
                }
                else{
                    setTimeout(function(){
                        waitForElement();
                    },250);
                }
            }
            waitForElement();
            
            
        },

        cacheEls: function () {
            this.$el = jQuery(this.el);
            var targetEl = this.$el.data('result-target') || '';
            this.$input = jQuery('#priceCalculatorInput');
            this.$form = jQuery('#priceCalculatorForm');
            this.$actions = this.$form.find('.actions');
            this.$nonprofit = jQuery('#non-profit');
            this.$pricingPlan = jQuery(targetEl) || this.$el.find('.pricingPlan');
            this.$freePlanButton = this.$actions.find("[data-pricing-button='freePlanButton']");
            this.$trialButton = this.$actions.find("[data-pricing-button='trialButton']");
            this.$buyButton = this.$actions.find("[data-pricing-button='buyButton']");
            this.$contactButton = this.$actions.find(".contact-form-trigger");
            
            var $priceBox = this.$pricingPlan.find('.price-box');

            this.$plan = {
                el: $priceBox,
                yearly: $priceBox.find('.price-yearly .price'),
                monthly: $priceBox.find('.price-monthly .price'),
                staff: $priceBox.find('.info'),
                biyearly: $priceBox.find('.biyearly-price')
            };
        },

        bindEvents: function () {
            this.$input.on('keyup paste', this.input);
            this.$nonprofit.on('change', this.setPrice);

            this.$plan.el.on('click', function () {
                if (jQuery(this).hasClass('contact')) {
                    window.location = 'mailto:sales@small-improvements.com';
                }
            });

            this.$plan.el.on('click', '.price-box-plan', function (e) {
                app.events.trigger('open-request-invoice', {
                    plan: jQuery(e.delegateTarget).data('plan'),
                    interval: jQuery(this).data('interval')
                });
            });

            app.events.on('pricing-invoice-input', this.setInput);
        },

        input: function () {
            this.users = parseInt(this.$input.val(), 10);
            app.events.trigger('pricing-calculator-input', this.users);
            debounce(this.setPrice(), 500);
            
        },

        setInput: function (event, users) {
            this.users = isNaN(users) ? '' : users;
            this.$input.val(this.users);
            debounce(this.setPrice(), 500);
        },

        setPrice: function () {
            console.log(this.$pricingPlan);
            var reset = false,
                users = this.users;

            if (!users || users < 1) {
                users = 1;
                reset = true;
                //this.$pricingPlan.removeClass('active');
            } else {
                //this.$pricingPlan.addClass('active');
            }

        var nonprofit = this.$nonprofit.is(':checked');
        users = getNormalizedUserCount(users, nonprofit);
        var price = getPricing(users, nonprofit);

        this.$plan.yearly.text('$' + price.yearly);
        this.$plan.monthly.text('$' + price.monthly);
        this.$plan.biyearly.text('$' + price.biyearly);
        this.$plan.el
            .toggleClass('free', reset ? false : price.free)
            .toggleClass('nonprofit', reset ? false : nonprofit)
            .toggleClass('calculated', !reset)
            .toggleClass('contact', !reset && price.volumePricing);
        this.$plan.staff
            .toggleClass('no-price', !reset && price.free)
            .toggleClass('calculated', !(reset || price.free))
            .toggleClass('discounted', price.discountApplied)
            .find('.staff-size').attr('data-users', users);


        this.$form.toggleClass('need-quote', parseFloat(price.yearly.replace(/,/g, '')) >= 1000);
        this.$actions.toggleClass('free', !reset && price.free);
        }
    };

    app.modules.pricingCalculator.init();
});