jQuery(document).ready(function($) {
  $('#fetch_properties_button').on('click', function() {
      $.ajax({
          url: arbo_api_data.ajax_url,
          type: 'POST',
          data: {
              action: 'fetch_properties',
          },
          success: function(response) {
              if (response.success) {
                  let properties = response.data;
                  let output = '';

                  properties.forEach(function(property) {
                      output += '<div class="property-card">';
                      output += '<h3>' + property.nome + '</h3>';
                      output += '<p>Preço: ' + property.preco + '</p>';
                      output += '<p>Endereço: ' + property.endereco + '</p>';
                      output += '</div>';
                  });

                  $('#properties_list').html(output);
              } else {
                  $('#properties_list').html('<p>' + response.data + '</p>');
              }
          },
          error: function(error) {
              console.log(error);
          }
      });
  });
});
