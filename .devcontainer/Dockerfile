FROM php:8.2-apache

# 開発ツールをインストール（git, unzip, zip, vim, curl, less, locales など）
RUN apt-get update && \
    apt-get install -y git unzip zip vim curl less locales && \
    rm -rf /var/lib/apt/lists/*

# 日本語ロケールを有効化
RUN sed -i -e 's/# ja_JP.UTF-8 UTF-8/ja_JP.UTF-8 UTF-8/' /etc/locale.gen && \
    locale-gen
ENV LANG=ja_JP.UTF-8
ENV LANGUAGE=ja_JP:ja
ENV LC_ALL=ja_JP.UTF-8

# Apacheのmod_rewriteを有効化
RUN a2enmod rewrite

# ポート80を公開
EXPOSE 80
CMD ["apachectl","start", "-D", "FOREGROUND"]
