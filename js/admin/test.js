//    $(document).on('click', '.c-stepy-next', function() {
//        var fieldset = $(this).parents('fieldset');
//        validateForms(fieldset, function() {
//            if(fieldset.find('.c-error-field') != 'undefined'){
//                alert('1');
//            }
//            else{
//                alert('2');
//            }
//        });        
//        event.preventDefault();
//    });
    
//$("button").click(function(){
//    $("p").hide("slow", function(){
//        alert("The paragraph is now hidden");
//    });
//});    


//function mySandwich(param1, param2, callback) {
//    alert('Started eating my sandwich.\n\nIt has: ' + param1 + ', ' + param2);
//  
//    $('#sandwich').animate({
//        opacity: 0
//    }, 5000, function() {
//        // Animation complete.
//    });
//  
//    if (callback && typeof(callback) === "function") {
//        callback();
//    }
//}
//
//mySandwich('ham', 'cheese', function() { 
//    alert('Finished eating my sandwich.');
//});

//var index, len;
//var a = ["a", "b", "c"];
//for (index = 0, len = a.length; index < len; ++index) {
//    console.log(a[index]);
//}

//var index;
//var a = ["a", "b", "c"];
//for (index = a.length - 1; index >= 0; --index) {
//    console.log(a[index]);
//}

//$http({
//    method: 'POST',
//    url: url,
//    data: $.param({fkey: "key"}),
//    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
//})


//app.directive('view', ['$compile', function (compile) {
//
//    return {
//        restrict: 'A',
//        scope: {
//            view: '@'
//        },
//        replace: true,   
//        template: '<div class="view"></div>',
//
//        controller: ['$scope', function (scope) {
//            scope.$watch('view', function (value) {
//                scope.buildView(value);
//            });
//        }],
//
//        link: function (scope, elm, attrs) {
//
//            scope.buildView = function (viewName) {
//                var view = compile('<div ' + viewName + '></div>')(scope);
//                elm.append(view);
//            }
//        }
//    }
//}]);

//http://plnkr.co/edit/KLM0JooCbk4iaritXr1a?p=preview