import React, { useEffect, useState } from 'react';



const socket = new WebSocket('ws://localhost:2346')
const Randomer = () => {

    const [randomNumber, setRandNum] = useState(0)

    useEffect(() => {

        socket.onopen = function (event) {
            socket.send(JSON.stringify({
                action: 'GET_RANDOM_NUMBER',
            }));
            console.log("send message");
        };

        socket.onmessage = function (e) {
            const data = JSON.parse(e.data || {})
            setRandNum(data?.random || -1)
            console.log("received: ", data);
        }

    }, [randomNumber])




    return <div>
        Random number: {randomNumber}
    </div>
}

export default Randomer;