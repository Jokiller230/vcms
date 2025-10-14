{ pkgs, lib, config, inputs, ... }:
let
  inherit (lib) getExe;

  port = "8000"; # 8080 already in use for adminer
in
{

  languages.php.enable = true;

  services = {
    # Manage database
    adminer.enable = true;

    # Using default values of the systemconfig.php
    mysql = {
      enable = true;
      initialDatabases = [{ name = "datenbankname"; }];

      ensureUsers = [{
        name = "username";
        password = "password";

        ensurePermissions = {
          "*.*" = "ALL PRIVILEGES";
        };
      }];
    };
  };

  processes = {
    vcms-server.exec = ''${getExe pkgs.php} -S 127.0.0.1:${port}'';
  };

  tasks = {
    "vcms:install" = {
      exec = ''
        if [ ! -f ./.installed ]; then
          cp ./installer.txt ./installer.php
          xdg-open http://127.0.0.1:${port}/installer.php

          touch .installed
        fi
      '';
      before = [ "devenv:processes:vcms-server" ];
    };
  };
}
