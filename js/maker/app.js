define([
       "jquery" , "underscore" , "backbone",
       "collections/snippets" , "collections/my-form-snippets",
       "views/tab" , "views/my-form",
       "text!data/input.json", "text!data/radio.json",
       "text!data/select.json", "text!templates/app/help.html",
], function(
  $, _, Backbone,
  SnippetsCollection, MyFormSnippetsCollection,
  TabView,
  MyFormView,
  inputJSON, radioJSON, selectJSON, helpTab
){
  return {
    initialize: function(){

      //Bootstrap tabs from json.
      new TabView({
        title: "Input",
        collection: new SnippetsCollection(JSON.parse(inputJSON))
      });
      new TabView({
        title: "Radios / Checkboxes",
        collection: new SnippetsCollection(JSON.parse(radioJSON))
      });
      new TabView({
        title: "Select",
        collection: new SnippetsCollection(JSON.parse(selectJSON))
      });
      new TabView({
        title: "Help",
        content: helpTab
      });

      //Make the first tab active!
      $("#components .tab-pane").first().addClass("active");
      $("#formtabs li").first().addClass("active");
      // Bootstrap "My Form" with 'Form Name' snippet.
      new MyFormView({
        title: "Original",
        collection: new MyFormSnippetsCollection([
          { "title" : "Form Name",
            "fields": {
              "name": {
                "label" : "Form Name",
                "type"  : "input",
                "value" : "Form Name"
              }
            }
          }
        ])
      });
    }
  };
});
