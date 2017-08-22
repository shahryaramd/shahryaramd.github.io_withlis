var http = require('http'),
  // And url module, which is very helpful in parsing request parameters.
  url = require("url"),
  // And fs module you've just installed.
  fs = require("fs");

var server = http.createServer(function(request, response) {
  var _get = url.parse(request.url, true).query;
  // Write headers to the response.
  // response.writeHead(200, {
  //   'Content-Type': 'text/plain'
  // });
  // Send data and end response.
  //response.end('Here is your data: ' + _get['data']);
  
  // Read the file.
  if (request.url == '/') {
    fs.readFile("test.txt", 'utf-8', function(error, data) {
      // Write headers.
      response.writeHead(200, {
        'Content-Type': 'text/plain'
      });
      // Increment the number obtained from file.
      data = parseInt(data) + 1;
      // Write incremented number to file.
      fs.writeFile('test.txt', data);
      // End response with some nice message.
      response.end('This page was refreshed ' + data + ' times!');
    });
  } else {
    // Indicate that requested file was not found.
    response.writeHead(404);
    // And end request without sending any data.
    response.end();
  }


});

server.listen(1342, '127.0.0.1');

console.log('Server running at http://127.0.0.1:1342/');
