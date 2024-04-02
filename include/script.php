<!-- <script>
    $(document).ready(function() {
        $('#getitemdata').select2().on('select2:select', function(e) {
            var selectedName = $(this).find(':selected').data('iname');
            var selectedPrice = $(this).find(':selected').data('price');
            $(this).nextAll('input[name^="item-name"]').val(selectedName);
            $(this).nextAll('input[name^="price"]').val(selectedPrice);
        });




        $('#addFieldButton').click(function() {
            let itemno = parseInt($('#hdata').val(), 10);
            itemno++;
            let newItemHtml = `
                <div class="item-group-${itemno}">
                    <select name="selectitem[]" class="item-select">
                        <option value="">Select Item</option>
                       
                    </select>
                    <input type="text" name="item-name-${itemno}" placeholder="Item Name">
                    <input type="text" name="price-${itemno}" placeholder="Price">
                    <input type="text" name="quantity-${itemno}" placeholder="Quantity">
                </div>
            `;
            $('#fieldsContainer').append(newItemHtml);
            $('.item-select:last').select2().on('select2:select', function(e) {
                var selectedName = $(this).find(':selected').data('iname');
                var selectedPrice = $(this).find(':selected').data('price');
                $(this).nextAll('input[name^="item-name"]').val(selectedName);
                $(this).nextAll('input[name^="price"]').val(selectedPrice);
            });
            let itemnos = parseInt($('#hdata').val(), 10);
            itemnos++;
            $('#hdata').val(itemnos);
        });

        $('#removef').click(function() {
            let itemnom = parseInt($('#hdata').val(), 10);
            if (itemnom > 1) {
                $('#fieldsContainer .item-group-' + itemnom).remove();
                itemnom--;
                $('#hdata').val(itemnom);
            }
        });

    });
</script> -->

