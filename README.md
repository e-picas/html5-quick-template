html5-quick-template - MDE version
==================================

This branch is a version of the original `master` to parse all Markdown syntax files of
a host as an HTML content and load it in a special version of the original `html5-quick-template`.

Please see the [original master](http://github.com/piwi/html5-quick-template) for more info.

    # virtual host sample config
    <VirtualHost *:80>
        DocumentRoot "/.../"
        ServerName localhost

        DocumentRoot "/.../"
        <Directory "/...">
            Options         +ExecCGI
            AddHandler      cgi-script  .sh
            AddType         text/html   .md .mde .markd .mdown .markdown
            AddHandler      MarkDown    .md .mde .markd .mdown .markdown
            Action          MarkDown    /cgi-bin/mde_apacheHandler.sh virtual
            AllowOverride   All
            Order           allow,deny
            allow from all
        </Directory>

        ScriptAlias /cgi-bin/ /.../cgi-bin/
        <Directory "/.../cgi-bin">
            Options         +ExecCGI    +FollowSymLinks
            AddHandler      cgi-script  .sh
            AddType         text/html   .md .mde .markd .mdown .markdown
            AddHandler      MarkDown    .md .mde .markd .mdown .markdown
            Action          MarkDown    mde_apacheHandler.sh virtual
            AllowOverride   All
            Order           allow,deny
            allow from all
        </Directory> 

    </VirtualHost>
