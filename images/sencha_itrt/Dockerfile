FROM java:8-jre

RUN apt-get update && \
    apt-get install -y \
        curl \
        ruby \
        unzip

RUN useradd -m sencha && \
    cd && cp -R .bashrc .profile /home/sencha && \
    mkdir -p /project && \
    chown -R sencha:sencha /home/sencha /project

USER sencha

ENV HOME /home/sencha

RUN curl -o /home/sencha/cmd.sh.zip http://cdn.sencha.com/cmd/6.2.1/no-jre/SenchaCmd-6.2.1-linux-amd64.sh.zip && \
    unzip -p /home/sencha/cmd.sh.zip > /home/sencha/cmd-install.sh && \
    chmod +x /home/sencha/cmd-install.sh && \
    /home/sencha/cmd-install.sh -q && \
    rm /home/sencha/cmd*

ENV PATH /home/sencha/bin/Sencha/Cmd/6.2.1.29:$PATH

VOLUME /project

WORKDIR /project

EXPOSE 1841

COPY sencha.sh /home/sencha/

ENTRYPOINT ["/home/sencha/sencha.sh"]

CMD ["help"]
