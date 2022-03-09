<style>
    .sample-cont {
        width: 350px;
        height: 350px;
        border: 1px solid #000;
        margin: 20px;
        overflow: auto;
    }
    /* width */
    .sample-cont::-webkit-scrollbar {
        width: .5px;
    }

    /* Track */
    .sample-cont::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    .sample-cont::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    .sample-cont::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .notif-bar {
        list-style: none;
        padding: 0;
        margin: 0;
        position: relative;
    }

    .notif-bar .active{
        background-color: #ccc;
    }


    .notif-bar li i{
        margin-top: 20px;
        left: 10px;
        width: 30px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        border: 1px solid #000;
        border-radius: 50%;
        position: absolute;
    }

    .notif-bar li a{
        color: #333;
        padding: 20px 0px;
        padding-left: 50px;
        padding-right: 20px;
        text-decoration: none;
        display: block;
    }

    .notif-bar li a:hover, .notif-bar li i:hover{
        color: #dbe2ef;
        background: #323232;
    }

    .notif-bar li a b{
        margin-left:50px;
    }
</style>
