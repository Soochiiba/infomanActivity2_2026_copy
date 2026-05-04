<html>
    <style>
        body 
        {
            display: flex;             
            flex-direction: column;    
            justify-content: center;   
            align-items: center;       
            height: 100%;             
            margin: 0;                 
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;

        }

        .main-container
        {
            display: flex;
            justify-content: center;
            background-color: #0454aa;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 5px 10px 5px rgba(0,0,0,0.2);
            text-align: center;
            overflow: hidden;
            height: 2%;
            min-width: 100px;
            color: white;

            transition: height 1s;
        }

        .main-container:hover
        {
            height: 35%;
        }

        .grid-container 
        {
            border-top: 5px solid #0d3575;
            padding: 10px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto auto auto;
            gap: 15px;
            min-width: 100px;
            max-width: 500px;
            margin: 0 auto;
        }

        .big_btn 
        {
            grid-column: span 2;
            color: #929ab2;
        }

        button 
        {
            box-shadow: 5px 5px 5px rgba(0,0,0,0.2);
        }

        .big_btn button {
            width: 100%;
            height: 30px; 
            background-color: #ffffff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
        }

        img 
        {
            width: 10%;
        }

        /* short buttons */
        .small_btn
        {
            background-color: #80a4ff;
            border: none;
            border-radius: 8px;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            width: 150px;
            height: 50px;
        }

        .small_btn:hover
        {
            background-color: #9bfcff;
            font-weight: bold;
            color: #037d51;
        }

        .mid_btn
        {
            background-color: #80a4ff;
            border: none;
            border-radius: 8px;
            color: black;
            padding: 15px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 0px;
            cursor: pointer;
            width: 150px;
            height: 80px;
        }

        .mid_btn:hover
        {
            background-color: #9bfcff;
            font-weight: bold;
            color: #037d51;
        }

        .big_btn button:hover
        {
            background-color: #9bfcff;
            font-weight: bold;
            color: #037d51;
        }

        #btn
        {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-weight: bold;
        }

        hr {
            border-top: 10px solid white;
        }

    </style>

    <head>
        <title> Mega Cat Studios - Page 2 </title>
    </head>

    <body>
        <img src="https://media.tenor.com/hegqVVuekjAAAAAj/neko-arc.gif" alt="necoarc.gif">
            <h2> Search Menu </h2>
        
        <div class ="main-container">
                
            <div class = "grid-container">
                <div class="grid-item big_btn">
                    <button class="big_btn" type="button" id="btn" onClick="window.location.href='../index.php'"> Home Page </button>
                </div>

                <div class ="grid-item">
                    <button class= "small_btn" type="button" id="btn" onClick="window.location.href='select-gamePub.php'"> Game Publishing </button>
                </div>

                <div class ="grid-item">
                    <button class= "small_btn" type="button" id="btn" onClick="window.location.href='select-depAssign.php'"> Department Assignment </button>
                </div>                
            </div>
            
        </div>
    </body>
</html>
