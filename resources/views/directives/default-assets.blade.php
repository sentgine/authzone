<link
    href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
    rel="stylesheet"
/>
<link href="{{ url('/authzone.min.css') }}" rel="stylesheet" />
<link href="{{ url('/authzone-select2.min.css') }}" rel="stylesheet" />
<style>[x-cloak]{display:none!important}</style>
<!-- Select2 -->
<script                    
    src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"
></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script defer>            
    $(document).ready(function () {
        $(".authzone-select2").select2();
        $(".authzone-select2-permissions").select2({
            placeholder: "Select a permission",
        });
        $(".authzone-select2-roles").select2({
            placeholder: "Select roles",
        });
        $(".authzone-select2-role").select2({
            placeholder: "Select a role",
        });
    });
</script>