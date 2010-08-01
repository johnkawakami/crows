
Crows.helloWorldWidget = function() {
  Ext.get('hello_world').update('Hello world.');
}

Ext.onReady( function() {
  if(Ext.get('hello_world')) Crows.helloWorldWidget();
});
