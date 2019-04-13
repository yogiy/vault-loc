
</div>
</div>

<script src="<?php echo base_url();?>assets/front/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="<?php echo base_url();?>assets/front//validation/validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".file1").change(function(e){
            var fileName = e.target.files[0].name;
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".fileTextNm1").css('color', 'red');
                $(".fileTextNm1").css('font-size', '12px');
                $(".fileTextNm1").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            $(".fileTextNm1").html(fileName);
        });

        $(".file2").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".fileTextNm2").css('color', 'red');
                $(".fileTextNm2").css('font-size', '12px');
                $(".fileTextNm2").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".fileTextNm2").html(fileName);
        });

        $(".file3").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".fileTextNm3").css('color', 'red');
                $(".fileTextNm3").css('font-size', '12px');
                $(".fileTextNm3").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".fileTextNm3").html(fileName);
        });

        $(".file4").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".fileTextNm4").css('color', 'red');
                $(".fileTextNm4").css('font-size', '12px');
                $(".fileTextNm4").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".fileTextNm4").html(fileName);
        });

        $(".file5").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".fileTextNm5").css('color', 'red');
                $(".fileTextNm5").css('font-size', '12px');
                $(".fileTextNm5").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".fileTextNm5").html(fileName);
        });

        $(".file-doc1").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".filedocNm1").css('color', 'red');
                $(".filedocNm1").css('font-size', '12px');
                $(".filedocNm1").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".filedocNm1").html(fileName);
        });

        $(".file-doc2").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".filedocNm2").css('color', 'red');
                $(".filedocNm2").css('font-size', '12px');
                $(".filedocNm2").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".filedocNm2").html(fileName);
        });

        $(".file-doc3").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".filedocNm3").css('color', 'red');
                $(".filedocNm3").css('font-size', '12px');
                $(".filedocNm3").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".filedocNm3").html(fileName);
        });

        $(".file-doc4").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".filedocNm4").css('color', 'red');
                $(".filedocNm4").css('font-size', '12px');
                $(".filedocNm4").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".filedocNm4").html(fileName);
        });

        $(".file-doc5").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".filedocNm5").css('color', 'red');
                $(".filedocNm5").css('font-size', '12px');
                $(".filedocNm5").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".filedocNm5").html(fileName);
        });
        $(".file-doc6").change(function(e){
            var fileExtension = ['xlsx', 'xls','pptx', 'jpg','jpeg','png','doc','csv','docx','ppt','pdf' ];
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                $(".filedocNm6").css('color', 'red');
                $(".filedocNm6").css('font-size', '12px');
                $(".filedocNm6").html("Only '.xlsx', '.xls','.pptx', '.jpg','.jpeg','.png','.doc','.csv','.docx','.ppt','.pdf' formats are allowed.");
                return false; }
            var fileName = e.target.files[0].name;
            $(".filedocNm6").html(fileName);
        });
    });
</script>
</body>
</html>