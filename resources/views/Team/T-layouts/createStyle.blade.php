<style>
    .form-inputs {
        float: right;
        width: 30%;
    }

    .form-image {
        float: left;
        width: 50%;
    }
    .clearfix:after {
        content: "";
        clear: both;
        display: table;
    }
/*
    .form-inputs {
        position: relative;
        border-left: 1px solid gray;
    }
*/
    /* Style the select element */
    #categoryDropdown {
        padding: 10px;
        border-radius: 4px;
        border: none;
        font-size: 16px;
        width: 100%;
    }

    /* Style the options in the dropdown */
    #categoryDropdown option {
        padding: 10px;
        font-size: 16px;

    }

    /* Add a hover effect to the options */
    #categoryDropdown option:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }


    input[type=file] {
        width: 100%; /* increase the width of the file input */
        height: 450px; /* increase the height of the file input */
    }

    preview {
        width: 50%;
        height: auto;
        display: block;
        margin: 0 auto;
    }

    /* zoom pan hover over image */

    .zoomModal {
        width: 100%;
        height: 100%;
        overflow: auto;
    }
</style>
