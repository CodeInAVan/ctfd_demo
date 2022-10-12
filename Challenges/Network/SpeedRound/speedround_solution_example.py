mport socket

HOST = "cyberchallenges.uk"
PORT = 10001

def main():
    with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
        s.connect((HOST, PORT))
        for i in range(1,10):
            data = s.recv(1024)
            if '0' in str(data):
                data = data.decode("utf-8").strip() 
                print("sending:", data)
                s.sendall(str.encode(data))
                print(s.recv(1024))

if __name__ == '__main__':
    main()
