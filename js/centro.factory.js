(function () {
    'use strict';
    
    angular.module('app.centro')
    .factory('$directores',['$rootScope','$http',Directores]);
    
    function Directores($rootScope,$http)
    {
        $rootScope.id_centro = '';
        return {
            
            load:function(id_centro)
            {
                var items = [];
                $http.post(SITE_URL+'admin/centros/load_directores',{id_centro:id_centro}).then(function(response){
                    
                    var results =  angular.fromJson(response.data);
                    
                    if(results.status)
                    {
                         $rootScope.directores = results.data;
                         
                        
                    }
                   
                    
                });
               
            }
        }
    }
})();