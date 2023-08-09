<div class="header">
    <a href="/"><img style="width: 80px" src="https://img.icons8.com/?size=512&id=8113&format=png" alt=""></a>
    <div class="buttons_for_header">
        <button>
            LOCATIONS
        </button>
        <button>
            EVENTS
        </button>
        <a href="/cart">
            <button>
                CART
            </button>
        </a>
        <a href="/dashboard">
            <button>
                PROFILE
            </button>
        </a>
    </div>
    <div style="margin-left: 10px; display: flex; justify-content: center; align-items: center">
        <input class="search_input" type="text" placeholder="Search">
        <img src="https://img.icons8.com/?size=512&id=132&format=png" style="width: 40px; margin-left: -50px">
    </div>
</div>

<style>
    .header {
        width: 100%;
        height: 15vh;
        background-color: #D3D3D3;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .buttons_for_header{
        margin-left: 30px;
        margin-right: 15px;
    }
    .buttons_for_header button {
        padding: 10px 5px;
        font-size: 18px;
        margin-right: 5px;
        border: none;
        cursor: pointer;
        transition: 0.5s all ease;
        background-color: transparent;
    }
    .buttons_for_header button:hover{
        font-size: 20px;
    }
    .search_input{
        font-size: 20px;
        background-color: #E0E0E0;
        border: none;
        padding: 20px;
        width: 750px;
    }
</style>
