html5-quick-template - MDE version
==================================

This branch is a version of the original `master` to parse all Markdown syntax files of
a host as an HTML content and load it in a special version of the original `html5-quick-template`.

Please see the [original master](http://github.com/piwi/html5-quick-template) for more info.

Installation
------------

    wget --no-check-certificate -O mde-master.tar.gz https://github.com/piwi/html5-quick-template/archive/mde-master.tar.gz
    tar -xvf mde-master.tar.gz
    cd html5-quick-template-mde-master/cgi-bin
    ln -s "$(pwd)/mde-cgi-handler.sh" {path to your server CGI binaries}/
    ln -s "$(pwd)/mde-html5-quick-template.html" {path to your server CGI binaries}/
    ln -s "$(pwd)/.htaccess" {path to your server CGI binaries}/
    ln -s "$(pwd)/mde-cgi-handler.sh" {path to your virtual host DOCUMENT_ROOT}/


Apache config
-------------

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
            Action          MarkDown    /cgi-bin/mde-cgi-handler.sh virtual
            AllowOverride   All
            Order           allow,deny
            allow from all
        </Directory>

        ScriptAlias /cgi-bin/ /.../cgi-bin/
        <Directory "/.../cgi-bin">
            SetEnv          MDE_TEMPLATE    mde-html5-quick-template.html
            Options         +ExecCGI        +FollowSymLinks
            AddHandler      cgi-script      .sh
            AddType         text/html       .md .mde .markd .mdown .markdown
            AddHandler      MarkDown        .md .mde .markd .mdown .markdown
            Action          MarkDown        mde-cgi-handler.sh virtual
            AllowOverride   All
            Order           allow,deny
            allow from all
        </Directory> 

    </VirtualHost>
