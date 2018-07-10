import requests
from flask import Flask, request, abort


app = Flask(__name__)


@app.route('/webhook', methods=['GET', 'POST'])
def webhook():
    if request.method == 'GET':
        verification_code = 'VERIFIED'
        verify_token = request.args.get('hub.verify_token')

        if verification_code == verify_token:
            return request.args.get('hub.challenge')
        return "Hello pronto"
    
    if request.method == 'POST':
        print(request.data)
        return request.data, 200

if __name__ == '__main__':
    app.run()
