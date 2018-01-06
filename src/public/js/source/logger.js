/**
 * PHP library to create logs easily and store them in Json format.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2017 - 2018 (c) Josantonius - PHP-Logger
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Loggerer
 * @since     1.1.2
 */

var LOOGER = (function() {
   var el = document.getElementsByClassName('jst-log-line');
   for (var i = 0 ; i < el.length; i++) {
      el[i].addEventListener('click', function() {
         var expand = document.querySelectorAll('[data-' + this.id + ']');
         for (var i = 0 ; i < expand.length; i++) {
            if (expand[i].classList.contains('jst-no-display') === true) {
               fadeIn(expand[i]);
            } else {
               fadeOut(expand[i]);
            }
         }
      }, false); 
   }

   /**
    * @author Ibu <http://idiallo.com>
    */
   function fadeIn(element) {
      var op = 0.1;
      element.classList.remove('jst-no-display');
      var timer = setInterval(function () {
         if (op >= 1){
            clearInterval(timer);
         }
         element.style.opacity = op;
         element.style.filter = 'alpha(opacity=' + op * 100 + ")";
         op += op * 0.1;
       }, 10);
   }

   /**
    * @author Ibu <http://idiallo.com>
    */
   function fadeOut(element) {
      var op = 1;
      var timer = setInterval(function () {
         if (op <= 0.1){
            clearInterval(timer);
            element.classList.add('jst-no-display');
         }
         element.style.opacity = op;
         element.style.filter = 'alpha(opacity=' + op * 100 + ")";
         op -= op * 0.1;
       }, 10);
   }

})();
