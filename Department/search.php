<?php
include "../re-use/db_conn.php";
?>


<input type="text" class="form-control" name="" id="live_search" autocomplete="off" placeholder="Search....">


<div id="search_result">

</div>
<!-- Google CDN -->
<script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#live_search").keyup(function() {
            var input = $(this).val();
            // alert(input);

            if (input != "") {
                $.ajax({
                    url: "livesearch.php",
                    method: "POST",
                    data: {
                        input: input
                    },

                    success: function(data) {
                        $(".table-container").css("display", "none");
                        $("#search_result").html(data);

                    }
                });
            } else {
                $("#search_result").css("display", "none");
            }

        });

    });
</script>