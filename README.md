olinuxino-web-io
================

OLinuXino GPIO Web Interface

1. Installing
1.1 lighttpd + mod_fastcgi + php-cgi
  To use olinuxino-web-io , you need web server and php installed.
  I use lighttpd + mod_fastcgi + php-cgi from Angstrom feeds.
  Sample  lighttpd configuration : 
      In /etc/lighttpd.conf, uncomment mod_fastcgi in server.modules section:
    
                  server.modules              = (

                      #                               "mod_setenv",
                                                          .......
                                                      "mod_fastcgi",  
                      #                                 "mod_proxy",
                      #                          "mod_simple_vhost",
                                                          ........
                      #                               "mod_webdav",
                                                    "mod_accesslog" )

  
  And add php configuration to mod_fastcgi :  
                  
                  fastcgi.server = ( ".php" => ((
                         "bin-path" => "/usr/bin/php-cgi",
                        "socket" => "/tmp/php.socket"
                      )))


   Restart  lighttpd :
              
              root@olinuxino:~# /etc/init.d/lighttpd restart
    
    now you must have working php.    
1.2 Installing OLinuXino Web IO
    
  
  
                