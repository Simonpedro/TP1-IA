<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TP1 - Inteligencia Artificial</title>
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <header>
                <h1 class="caratula"> TP1 - Inteligencia Artifial - Pedro Simon, Fabricio Neirotti, Ciro Pedrini</h1>
        </header>
        <div class="container group">
            
            <section class="content clearfix">
                <div class="section-data-input left card">
                    <h2>Tabla de precedencias</h2>
                    <div class="precedencias" data-bind="foreach: precedencias" >
                        <p>
                            <input type="text" data-bind="value: nodo" disabled/> precede a <input type="text" data-bind="value: precedeA" disabled/>
                        </p>
                    </div>
                    <div>
                        <input id="nodoPredecesor" data-bind="value: predecesor" type="text"/> precede a <input id="nodoSucesor" data-bind="value: sucesor" type="text"/>
                        <button type="submit" data-bind="click: addPrecedencia">Agregar precedencia</button>
                    </div>
                </div>
                <div class="result left card">
                    <h2>Resultado</h2>
                    <p id="resultado"></p>
                </div>
                
            </section>
            <div class="section-search clearfix">
                <p>¿Depende la ciudad <input type="text" data-bind="value: objetivo" /> de <input type="text" data-bind="value: raiz" />?</p> 
                <button data-bind="click: resolve">Resolver</button>
            </div>
        </div>
        <script src="js/jquery-3.0.0.min.js"></script>
        <script src="js/knockout-3.4.0.js"></script>
        
        <script>
            //Modelo de Knockout
            // El nodo precede (está antes) 
            function Precedencia(nodo, precedeA) {
                this.nodo = nodo;
                this.precedeA = precedeA;
            }
            
            function ViewModel() {
                var self = this;
                
                
                self.precedencias = ko.observableArray();
                self.predecesor = ko.observable("");
                self.sucesor = ko.observable("");
                self.objetivo = ko.observable("");
                self.raiz = ko.observable("");
                
                self.addPrecedencia = function() {
                    if(!(isEmpty(self.sucesor()) || isEmpty(self.predecesor()))) {
                        self.precedencias.push(new Precedencia(self.predecesor(), self.sucesor()));
                        self.predecesor("");self.sucesor("");
                        
                    }
                }
                
                self.resolve = function() {
                    var jsonString = ko.toJSON(self.precedencias);
                    $.ajax({
                        url: "result.php",
                        data: {data: self.precedencias(),
                               nodoRaiz: self.raiz(),
                               nodoObjetivo: self.objetivo()},
                        success: function(result) {
                            $('#resultado').hide();
                            $('#resultado').html(result);
                            $('#resultado').fadeIn("slow");
                        }
                    });
                }
            }
            
            ko.applyBindings(new ViewModel());
            
            //Funciones utiles
            
            function isEmpty(str) {
                return (!str || 0 === str.length);
            }
        </script>
        
    </body>
</html>
