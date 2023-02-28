$(document).ready(function() {
    //when plus button click
    $('.btn-plus').click(function(){
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#pizzaPrice').text().replace("Kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty ;
        $parentNode.find('#total').html($total + " Kyats");

        summaryCalculation();



    })

    $('.btn-minus').click(function(){
        //when minus button click
        $parentNode = $(this).parents("tr");
        $price = Number($parentNode.find('#pizzaPrice').text().replace("Kyats",""));
        $qty = Number($parentNode.find('#qty').val());
        $total = $price * $qty ;
        $parentNode.find('#total').html($total + " Kyats");

        summaryCalculation();
    })

    $('.btnRemove').click(function(){
        //remove button click
        $parentNode = $(this).parents("tr");
        $parentNode.remove();

        summaryCalculation();

    })

    function summaryCalculation(){
        //calculate final total
        $totalPrice = 0 ;
        $('#dataTable tbody tr').each(function(index,row){
            $totalPrice += Number($(row).find('#total').text().replace("Kyats",""));

        })

        $('#subTotalPrice').html(`${$totalPrice} Kyats`);
        $('#finalTotal').html(`${$totalPrice + 3000} Kyats`);
    }
})
