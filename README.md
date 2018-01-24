# ODNDash

Make sure you have Obsidian-QT running on Ubuntu first. You can follow my guide for installing it on Amazon AWS here: https://pastebin.com/RRPmDVy1

To install ODNDash, follow the next steps while connected to your VPS over SSH:
1) If Obsidiand is running, stop the wallet with the command 'sudo obsidiand stop'
2) Change directory to /home/[username]/.obsidian with the command 'cd /home/[username]/.obsidian'. 
3) Open obsidian.conf for editing: 'sudo nano obsidian.conf'.
4) Remove any text in this file and add the following lines:
    server=1
    rpcuser=[choose a username]
    rpcpassword=[choose a password]
    rpcport=8332
   Choose your own username and password.
5) Exit and save the file with Ctrl+X, press Y for save changes, don't change the filename (press ENTER).
6) Restart your wallet with 'sudo obsidiand --daemon' and unlock your wallet for staking.
7) Install Apache webserver on your Ubuntu server with the following commands:
    sudo apt-get update
    sudo apt-get install apache2
8) After installation is complete, run the following command to add Apache to the firewall exceptions: 'sudo ufw allow in "Apache Full"'
9) If you are using Amazon AWS, you should add HTTP-access over port 80 to the Security Group of your Instance. This can be done in the Management Console -> Security Groups -> Select the active Security Group -> In the lower part of the screen go to the tab 'Inbound' and press 'Edit'. Press 'Add Rule', in the new window select 'HTTP' in the dropdown menu from Type. Leave the rest like it is and press Save.
10) You should now be able to access your Apache server on your Ubuntu server by entering the public IP-address in your browser. Your public IP-address of your Amazon AWS can be found on the Instances page under IPv4 Public IP.
11) Back in your SSH command line, install PHP with the following command: 'sudo apt-get install php libapache2-mod-php php-mcrypt php-curl'
12) Restart Apache with the command: 'sudo systemctl restart apache2'
13) Now you have Apache and PHP installed, you can clone the ODNDash software.
14) Navigate to /var/www/html with the command 'cd /var/www/html'.
15) Remove the standard 'index.html' with the command 'sudo rm index.html'.
16) Clone this GIT with the command 'sudo git clone https://github.com/tluijf/ODNDash'.
17) Open the newly created folder ODNDash with 'cd ODNDash/'.
18) Before using the software, you have to enter your chosen username and password from step 4. Enter the following command to open the wallet_func.php file: 'sudo nano wallet_func.php'.
19) Find the row where it says: "$user = 'user';". Replace user with the username you chose in step 4.
20) In the next row where it says: "$password = 'password';". Replace password with the password you chose in step 4.
21) Exit and save the file with Ctrl+X, press Y for save changes, don't change the filename (press ENTER).

You should now be able to access your private ODNDash via your browser. Browse to http://[ipaddress]/ODNDash/index.php.

For any questions, contact @TPRCoop on Official Obsidian Discord (https://discord.gg/WQhfey2).

Tips are welcome in ODN via ODN Address: XUtqN4qzAWGeXR8GQUuQmY6YhMhwqqs7Qi
Tips are welcome in any ERC-20 token or Ether via address: 0x8BCDd9F4f4984c8fe5b2B3684b3308D35299933D

Good luck and Happy Staking,

TPRCoop
