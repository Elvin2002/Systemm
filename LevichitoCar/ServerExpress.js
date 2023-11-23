const express = require('express');
const http = require('http');
const socketIo = require('socket.io');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const cors = require('cors');

const app = express();
app.use(cors());
const server = http.createServer(app);
const io = socketIo(server);

app.use(bodyParser.json());

const db = mysql.createConnection({
    host: '127.0.0.1',
    user: 'root',
    password: '',
    port: '3307',
    database: 'levishitocardb'
});
const corsOptions = {
    origin: 'http://127.0.0.1:8000', // Reemplaza con el dominio de tu aplicación Laravel
    optionsSuccessStatus: 200,
};

app.use(cors(corsOptions));


db.connect((err) => {
    if (err) {
        console.error('Error al conectar a la base de datos:', err);
        return;
    }
    console.log('Conectado a la base de datos mysql');
});

// Middleware para registrar detalles de las solicitudes
app.use((req, res, next) => {
    console.log(`Solicitud recibida: ${req.method} ${req.url}`);
    next();
});

io.on('connection', (socket) => {
    console.log('Conexión exitosa');
    socket.on('ejecutar-consulta', (query) => {
        db.query(query, (err, resultados) => {
            if (err) {
                console.error('Error al ejecutar la consulta', err);
                return;
            }
            // Emite el evento 'query-resultado' a todos los clientes conectados
            io.emit('query-resultado', resultados);
        });
    });


    socket.on('disconnect', () => {
        console.log('Cliente desconectado');
    });
});

// Ruta para manejar las solicitudes GET desde Laravel
app.get('/obtener-clientes', (req, res) => {
    // Ejecuta la consulta en la base de datos
    db.query('SELECT COUNT(*) as total_clientes FROM clientes', (error, results) => {
        if (error) {
            console.error('Error al ejecutar la consulta:', error);
            res.status(500).json({ error: 'Error al obtener datos de la tabla clientes' });
        } else {
            // Devuelve los resultados como JSON
            res.json(results);
        }
    });
});

app.get('/ejecutar-consulta', (req, res) => {
    const consulta = req.query.consulta; // Obtén el parámetro consulta de la URL

    // Ejecutar la consulta en la base de datos
    db.query(consulta, (err, resultados) => {
        if (err) {
            console.error('Error al ejecutar la consulta', err);
            res.status(500).json({ error: 'Error al obtener datos de la tabla clientes' });
        } else {
            // Emitir los resultados a través de Socket.IO
            io.emit('query-resultado', resultados);

            // Responder con los resultados
            res.json({ resultados: resultados });
        }
    });
});

const PORT = process.env.PORT || 3001;
server.listen(PORT, () => {
    console.log(`Servidor Express con Socket.IO escuchando en el puerto ${PORT}`);
});
