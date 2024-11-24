

<html>
   <head>
      <title>Ajax Example</title>
        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <style>
            #product-table {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
            #product-table td, #product-table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #product-table tr:nth-child(even){background-color: #f2f2f2;}

            #product-table tr:hover {background-color: #ddd;}

            #product-table th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04AA6D;
                color: white;
            }
            .heading-wrapper {
                width: 100%; 
                text-align: center;
                background-color: #f0f0f0;
                padding: 10px;
            }

            h4 {
                color: #e74c3c; /* Example color */
                font-size: 20px; /* Example font size */
                margin: 0; /* Remove default margin */
            }

        </style>
        <script>
            $(document).ready(function(){
                $('#show').click(function(){
                    $(this).css('display','none');
                  
                    $.ajax({
                        type:'POST',
                        url:'/get-products',
                        data:{
                            '_token': '<?php echo csrf_token() ?>',
                            totalAmount:200,
                            customerType:'VIP'
                        },
                        success:function(data) {
                            var html = '<table id="product-table">'+
                                        '<tr>'+
                                        ' <th>SlNo.</th>'+
                                            '<th>Name</th>'+
                                        ' <th>Color</th>'+
                                        '</tr>'+
                                        '<tbody>';
                                        $.each(data.data,function(key,value){
                                        html+= ' <tr>'+
                                                '<td>'+key+'</td>'+
                                                '<td>'+value.name+'</td>'+
                                            ' <td>'+value.color+'</td>'+
                                            '</tr>';
                                            })
                                    html+=' </tbody>'+
                                        '</table>';
                            $("#products").html(html);  
                        },
                        error: function(data)
                        {
                            console.log("data : " + data);
                        }
                    });
                })
            }) 
        </script>
   </head>
   
   <body>
        <div class="heading-wrapper">
            <h4>Products</h4>
        </h4>
        <button id="show">Show Products</button>
        <div id="products"></div>
   </body>

</html>