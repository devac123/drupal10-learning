/**
 * @file
 * My adminal behaviors.
 */
(function (Drupal) {

  'use strict';

  Drupal.behaviors.myAdminal = {
    attach (context, settings) {

      
      let headersList = {
        "X-Shopify-Storefront-Access-Token": "246ababac615bfff9c1d5f2cb7d67f86",
        "Content-Type": "application/json"
      };
      
      let gqlBody = {
        query: `
          {
            products(first: 20) {
              nodes {
                id
                title
              }
            }
          }
        `,
        variables: "{}"
      };
      
      let bodyContent = JSON.stringify(gqlBody);
      
      jQuery.ajax({
        url: "https://www.nutrishopusa.com/api/2023-07/graphql",
        type: "POST",
        data: bodyContent,
        headers: headersList,
        dataType: "json", // assuming the response is in JSON format
        success: function(data) {
         
          let respData = data.data.products.nodes
           for (const [key, value] of Object.entries(respData)) {
            let option_element = new Option(value.title,key,false,false);
             jQuery('#select2_search').html(option_element);
            //  console.log(`${key}: ${value.title}`);
          }
          jQuery('#select2_search').select2()
        },
        error: function(error) {
          console.error(error);
        }
      });
     


      jQuery('#select2_search').on('blur',function(){
        console.log('blur')
      })
      jQuery('#select2_search option').on('click',function(){
        console.log('closed')
      })
      
      function myClickfunction(){
        jQuery('#example').append('<div>abc text </div>')
      }

      jQuery('#select2_search').on('focus',function(){
        console.log('focus')
      })

    }
  };

} (Drupal));
